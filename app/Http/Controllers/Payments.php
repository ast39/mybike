<?php

namespace App\Http\Controllers;

use App\Http\Filters\PaymentFilter;
use App\Http\Requests\Payment\PaymentFilterRequest;
use App\Http\Requests\Payment\PaymentStoreRequest;
use App\Http\Requests\Payment\PaymentUpdateRequest;
use App\Http\Traits\Dictionarable;
use App\Libs\Helper;
use App\Models\Payment;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Payments extends Controller {

    use Dictionarable;


    /**
     * Список трат
     *
     * @param PaymentFilterRequest $request
     * @return View
     * @throws BindingResolutionException
     */
    public function index(PaymentFilterRequest $request): View
    {
        $data = $request->validated();

        $filter = app()->make(PaymentFilter::class, [
            'queryParams' => array_filter($data)
        ]);

        $payments = Helper::isAdmin()
            ? Payment::with(['bike', 'type'])
                ->filter($filter)
                ->orderByDesc('created_at')
                ->paginate(config('limits.payments'))
            : Payment::with(['bike', 'type'])
                ->where('client_id', Auth::id())
                ->filter($filter)
                ->orderByDesc('created_at')
                ->paginate(config('limits.payments'));

        $payments_all = Helper::isAdmin()
            ? Payment::filter($filter)
                ->orderByDesc('created_at')
                ->get()
            : Payment::where('client_id', Auth::id())
                ->filter($filter)
                ->orderByDesc('created_at')
                ->get();

        return view('payment.index', [
            'payments' => $payments,
            'payments_all' => $payments_all,
            'bikes'  => $this->bikes(),
            'types' => $this->payment_types(),
        ]);
    }

    /**
     * Форма добавления траты
     *
     * @return View
     */
    public function create(): View
    {
        return view('payment.create', [
            'bikes'  => $this->bikes(),
            'types' => $this->payment_types(),
        ]);
    }

    /**
     * Сохранение новой траты
     *
     * @param PaymentStoreRequest $request
     * @return RedirectResponse
     */
    public function store(PaymentStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['client_id'] = Auth::id();
        if (!is_null($data['payment_date'] ?: null)) {
            $data['created_at'] = strtotime($data['payment_date']);
        }

        return redirect()->route('payment.show', Payment::create($data)->payment_id);
    }

    /**
     * Страница трат
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $payment = Helper::isAdmin()
            ? Payment::with(['client', 'bike', 'type'])
                ->findOrFail($id)
        : Payment::with(['client', 'bike', 'type'])
                ->where('client_id', Auth::id())
                ->findOrFail($id);

        return view('payment.show', [
            'payment' => $payment,
            'bikes'    => $this->bikes(),
        ]);
    }

    /**
     * Страница редактирования траты
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $payment = Payment::where('client_id', Auth::id())
            ->findOrFail($id);

        return view('payment.edit', [
            'payment' => $payment,
            'bikes'    => $this->bikes(),
            'types'   => $this->payment_types(),
        ]);
    }

    /**
     * Обновление траты
     *
     * @param PaymentUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(PaymentUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        if (!is_null($data['payment_date'] ?: null)) {
            $data['created_at'] = strtotime($data['payment_date']);
        }

        $payment = Payment::find($id);

        if (is_null($payment)) {
            return back()->withErrors(['action' => 'Трата не найдена']);
        }

        if ($payment->client_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя изменять чужую трату']);
        }

        $payment->update($data);

        return redirect()->route('payment.show', $id);
    }

    /**
     * Удаление траты
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $payment = Payment::find($id);

        if (is_null($payment)) {
            return back()->withErrors(['action' => 'Трата не найдена']);
        }

        if ($payment->client_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя удалять чужую трату']);
        }

        $payment->delete();

        return redirect()->route('payment.index');
    }
}

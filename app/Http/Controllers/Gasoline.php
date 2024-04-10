<?php

namespace App\Http\Controllers;

use App\Http\Filters\GasFilter;
use App\Http\Requests\Gas\GasFilterRequest;
use App\Http\Requests\Gas\GasStoreRequest;
use App\Http\Requests\Gas\GasUpdateRequest;
use App\Http\Traits\Dictionarable;
use App\Libs\Helper;
use App\Models\Gas;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Gasoline extends Controller {

    use Dictionarable;


    /**
     * Список заметок
     *
     * @param GasFilterRequest $request
     * @return View
     * @throws BindingResolutionException
     */
    public function index(GasFilterRequest $request): View
    {
        $data = $request->validated();

        $filter = app()->make(GasFilter::class, [
            'queryParams' => array_filter($data)
        ]);

        return view('gas.index', [
            'gasoline' => Gas::with('bike')
                ->where('client_id', Auth::id())
                ->filter($filter)
                ->orderByDesc('created_at')
                ->paginate(config('limits.gas')),
            'gasoline_all' => Gas::where('client_id', Auth::id())
                ->filter($filter)
                ->orderByDesc('created_at')
                ->get(),
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Форма добавления заметки
     *
     * @return View
     */
    public function create(): View
    {
        return view('gas.create', [
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Сохранение новой заметки
     *
     * @param GasStoreRequest $request
     * @return RedirectResponse
     */
    public function store(GasStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['client_id'] = Auth::id();
        if (!is_null($data['gas_date'] ?: null)) {
            $data['created_at'] = strtotime($data['gas_date']);
        }

        return redirect()->route('gas.show', Gas::create($data)->record_id);
    }

    /**
     * Страница заметки
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $gas = Helper::isAdmin()
            ? Gas::with(['client', 'bike'])
                ->findOrFail($id)
            : Gas::with(['client', 'bike'])
                ->where('client_id', Auth::id())
                ->findOrFail($id);

        return view('gas.show', [
            'gas'  => $gas,
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Страница редактирования заметки
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $gas = Gas::where('client_id', Auth::id())
            ->findOrFail($id);

        return view('gas.edit', [
            'gas' => $gas,
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Обновление заметки
     *
     * @param GasUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(GasUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        if (!is_null($data['gas_date'] ?: null)) {
            $data['created_at'] = strtotime($data['gas_date']);
        }

        $gas = Gas::find($id);

        if (is_null($gas)) {
            return back()->withErrors(['action' => 'Заправка не найдена']);
        }

        if ($gas->client_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя изменять чужую заправку']);
        }

        $gas->update($data);

        return redirect()->route('gas.show', $id);
    }

    /**
     * Удаление заметки
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $gas = Gas::find($id);

        if (is_null($gas)) {
            return back()->withErrors(['action' => 'Заправка не найдена']);
        }

        if ($gas->client_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя удалять чужую заправку']);
        }

        $gas->delete();

        return redirect()->route('gas.index');
    }
}

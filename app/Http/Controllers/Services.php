<?php

namespace App\Http\Controllers;

use App\Http\Filters\ServiceFilter;
use App\Http\Requests\Service\ServiceFilterRequest;
use App\Http\Requests\Service\ServiceStoreRequest;
use App\Http\Requests\Service\ServiceUpdateRequest;
use App\Http\Traits\Dictionarable;
use App\Models\Service;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Services extends Controller {

    use Dictionarable;


    /**
     * Список сервисных работ
     *
     * @param ServiceFilterRequest $request
     * @return View
     * @throws BindingResolutionException
     */
    public function index(ServiceFilterRequest $request): View
    {
        $data = $request->validated();

        $filter = app()->make(ServiceFilter::class, [
            'queryParams' => array_filter($data)
        ]);

        return view('service.index', [
            'works' => Service::filter($filter)
                ->orderByDesc('created_at')
                ->paginate(20),
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Форма добавления записи о работе
     *
     * @return View
     */
    public function create(): View
    {
        return view('service.create', [
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Сохранение новой записи о работе
     *
     * @param ServiceStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ServiceStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['client_id'] = Auth::id();

        return redirect()->route('service.show', Service::create($data)->record_id);
    }

    /**
     * Страница записи о работе
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $work = Service::with(['client', 'bike'])
            ->findOrFail($id);

        return view('service.show', [
            'work' => $work,
        ]);
    }

    /**
     * Страница редактирования записи о работе
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $work = Service::findOrFail($id);

        return view('service.edit', [
            'work'  => $work,
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Обновление данных в записи о работе
     *
     * @param ServiceUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ServiceUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        $work = Service::find($id);

        if (is_null($work)) {
            return back()->withErrors(['action' => 'Запись не найдена']);
        }

        if ($work->client_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя изменять чужую запись']);
        }

        $work->update($data);

        return redirect()->route('service.show', $id);
    }

    /**
     * Удаление записи о работе
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $work = Service::find($id);

        if (is_null($work)) {
            return back()->withErrors(['action' => 'Запись не найдена']);
        }

        if ($work->client_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя удалять чужую запись']);
        }

        $work->delete();

        return redirect()->route('service.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Filters\BikeFilter;
use App\Http\Requests\Bike\BikeFilterRequest;
use App\Http\Requests\Bike\BikeStoreRequest;
use App\Http\Requests\Bike\BikeUpdateRequest;
use App\Http\Traits\Dictionarable;
use App\Libs\Helper;
use App\Models\Bike;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Bikes extends Controller {

    use Dictionarable;


    /**
     * Список авто
     *
     * @param BikeFilterRequest $request
     * @return View
     * @throws BindingResolutionException
     */
    public function index(BikeFilterRequest $request): View
    {
        $data = $request->validated();

        $filter = app()->make(BikeFilter::class, [
            'queryParams' => array_filter($data)
        ]);

        $bikes = Helper::isAdmin()
            ? Bike::filter($filter)
                ->orderByDesc('created_at')
                ->paginate(config('limits.bikes'))
            : Bike::where('owner_id', Auth::id())
                ->filter($filter)
                ->orderByDesc('created_at')
                ->paginate(config('limits.bikes'));

        return view('bike.index', [
            'bikes'  => $bikes,
            'marks' => $this->marks(),
        ]);
    }

    /**
     * Форма добавления авто
     *
     * @return View
     */
    public function create(): View
    {
        return view('bike.create', [
            'marks' => $this->marks(),
            'bikes'  => $this->bikes(),
        ]);
    }

    /**
     * Сохранение нового авто
     *
     * @param BikeStoreRequest $request
     * @return RedirectResponse
     */
    public function store(BikeStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['owner_id'] = Auth::id();

        return redirect()->route('bike.show', Bike::create($data)->bike_id);
    }

    /**
     * Страница авто
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $bike = Helper::isAdmin()
            ? Bike::with(['owner', 'works', 'catalog', 'gasoline', 'payments', 'notes'])
                ->findOrFail($id)
            : Bike::with(['owner', 'works', 'catalog', 'gasoline', 'payments', 'notes'])
                ->where('owner_id', Auth::id())
                ->findOrFail($id);

        return view('bike.show', [
            'bikes' => $this->bikes(),
            'bike'  => $bike,
            'bike_id' => $bike->bike_id,
        ]);
    }

    /**
     * Страница редактирования авто
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $bike = Bike::where('owner_id', Auth::id())
            ->where('owner_id', Auth::id())
            ->findOrFail($id);

        return view('bike.edit', [
            'bike'   => $bike,
            'marks' => $this->marks(),
            'bikes'  => $this->bikes(),
        ]);
    }

    /**
     * Обновление данных об авто
     *
     * @param BikeUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BikeUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        $bike = Bike::find($id);

        if (is_null($bike)) {
            return back()->withErrors(['action' => 'Автомобиль не найден']);
        }

        if ($bike->owner_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя изменять чужой автомобиль']);
        }

        $bike->update($data);

        return redirect()->route('bike.show', $id);
    }

    /**
     * Удаление авто
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $bike = Bike::find($id);

        if (is_null($bike)) {
            return back()->withErrors(['action' => 'Автомобиль не найден']);
        }

        if ($bike->owner_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя удалять чужой автомобиль']);
        }

        $bike->delete();

        return redirect()->route('bike.index');
    }
}

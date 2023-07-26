<?php

namespace App\Http\Controllers;

use App\Http\Filters\BikeFilter;
use App\Http\Requests\Bike\BikeFilterRequest;
use App\Http\Requests\Bike\BikeStoreRequest;
use App\Http\Requests\Bike\BikeUpdateRequest;
use App\Http\Traits\Dictionarable;
use App\Models\Bike;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Bikes extends Controller {

    use Dictionarable;


    /**
     * Список байков
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

        return view('bike.index', [
            'bikes' => Bike::filter($filter)
                ->orderBy('mark_id')
                ->paginate(20),
            'marks' => $this->marks(),
        ]);
    }

    /**
     * Форма добавления байка
     *
     * @return View
     */
    public function create(): View
    {
        return view('bike.create', [
            'marks' => $this->marks(),
        ]);
    }

    /**
     * Сохранение нового байка
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
     * Страница байка
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $bike = Bike::with(['owner', 'works', 'catalog', 'notes'])
            ->findOrFail($id);

        return view('bike.show', [
            'bike'  => $bike,
        ]);
    }

    /**
     * Страница редактирования байка
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $bike = Bike::findOrFail($id);

        return view('bike.edit', [
            'bike'  => $bike,
            'marks' => $this->marks(),
        ]);
    }

    /**
     * Обновление данных о байке
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
            return back()->withErrors(['action' => 'Байк не найден']);
        }

        if ($bike->owner_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя изменять чужой мотоцикл']);
        }

        $bike->update($data);

        return redirect()->route('bike.show', $id);
    }

    /**
     * Удаление байка
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $bike = Bike::find($id);

        if (is_null($bike)) {
            return back()->withErrors(['action' => 'Байк не найден']);
        }

        if ($bike->owner_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя удалять чужой мотоцикл']);
        }

        $bike->delete();

        return redirect()->route('bike.index');
    }
}

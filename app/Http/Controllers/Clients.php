<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\ClientUpdateRequest;
use App\Http\Traits\Dictionarable;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class Clients extends Controller {

    use Dictionarable;


    /**
     * Список клиентов
     *
     * @return View
     */
    public function index(): View
    {
        $client = User::with(['bikes'])
            ->findOrFail(Auth::id());

        return view('client.show', [
            'client' => $client,
            'bikes'   => $this->bikes(),
        ]);
    }

    /**
     * Мой профиль
     *
     * @return View
     */
    public function show(): View
    {
        $client = User::with(['bikes'])
            ->findOrFail(Auth::id());

        return view('client.show', [
            'client' => $client,
            'bikes'   => $this->bikes(),
        ]);
    }

    /**
     * Страница добавления клиента
     *
     * @return View
     */
    public function create(): View
    {
        $client = User::findOrFail(Auth::id());

        return view('client.create');
    }

    /**
     * Добавление клиента
     *
     * @param ClientStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ClientStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $client->update($data);

        return redirect()->route('client.index');
    }

    /**
     * Страница редактирования клиента
     *
     * @return View
     */
    public function edit(): View
    {
        $client = User::findOrFail(Auth::id());

        return view('client.edit', [
            'client' => $client,
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Обновление данных о клиенте
     *
     * @param ClientUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ClientUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $client = User::find(Auth::id());

        if (is_null($client)) {
            return back()->withErrors(['action' => 'Клиент не найден']);
        }

        if ($client->id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя изменять чужой профиль']);
        }

        $client->update($data);

        return redirect()->route('client.index');
    }
}

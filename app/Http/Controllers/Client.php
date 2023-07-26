<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\ClientUpdateRequest;
use App\Http\Traits\Dictionarable;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class Client extends Controller {

    use Dictionarable;


    /**
     * Мой профиль
     *
     * @return View
     */
    public function index(): View
    {
        $client = User::with(['bikes'])
            ->findOrFail(Auth::id());

        return view('client.show', [
            'client' => $client,
        ]);
    }

    /**
     * Страница байка
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        if ($id != Auth::id() && Auth::id() != 1) {
            abort(404);
        }

        $client = User::with(['bikes'])
            ->findOrFail($id);

        return view('client.show', [
            'client' => $client,
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
        $client = User::findOrFail($id);

        return view('client.edit', [
            'client' => $client,
        ]);
    }

    /**
     * Обновление данных о байке
     *
     * @param ClientUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ClientUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        $client = User::find($id);

        if (is_null($client)) {
            return back()->withErrors(['action' => 'Клиент не найден']);
        }

        if ($client->id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя изменять чужой профиль']);
        }

        $client->update($data);

        return redirect()->route('client.show', $id);
    }
}

<?php

namespace App\Http\Traits;

use App\Models\Bike;
use App\Models\Article;
use App\Models\MotoMark;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait Dictionarable {

    /**
     * Все клиенты
     *
     * @return array
     */
    protected function marks(): array
    {
        return MotoMark::all()->toArray();
    }

    /**
     * Все клиенты
     *
     * @return array
     */
    protected function clients(): array
    {
        return User::all()->toArray();
    }

    /**
     * Все мотоциклы
     *
     * @return array
     */
    protected function bikes(): array
    {
        return Bike::where('owner_id', Auth::id())
            ->get()
            ->toArray();
    }

    /**
     * Все запчасти
     *
     * @return array
     */
    protected function articles(): array
    {
        return Article::where('client_id', Auth::id())
            ->get()
            ->toArray();
    }

    /**
     * Все заметки
     *
     * @return array
     */
    protected function notes(): array
    {
        return Note::where('client_id', Auth::id())
            ->get()
            ->toArray();
    }
}

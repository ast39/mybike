<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Байки клиента
     *
     * @return HasMany
     */
    public function bikes(): HasMany
    {
        return $this->hasMany(Bike::class, 'owner_id', 'id')
            ->with('works')
            ->orderByDesc('created_at');
    }

    /**
     * Сервисные работы
     *
     * @return HasMany
     */
    public function works(): HasMany
    {
        return $this->hasMany(Service::class, 'client_id', 'id')
            ->orderByDesc('created_at');
    }

    /**
     * Каталог запчастей клиента
     *
     * @return HasMany
     */
    public function catalog(): HasMany
    {
        return $this->hasMany(Article::class, 'client_id', 'id')
            ->orderByDesc('created_at');
    }

    /**
     * Заметки клиента
     *
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, 'client_id', 'id')
            ->orderByDesc('created_at');
    }


    /**
     * Сразу же просчитаем кол-во обслуживаний
     *
     * @return int
     */
    public function getVisitsAttribute(): int
    {
        return Service::where('client_id', $this->id)
            ->count() ?: 0;
    }

    /**
     * Сразу же просчитаем сколько потрачено на обслуживание
     *
     * @return int
     */
    public function getCashedAttribute(): int
    {
        return Service::where('client_id', $this->id)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'created_at'        => 'timestamp',
        'updated_at'        => 'timestamp',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'year', 'card_id', 'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

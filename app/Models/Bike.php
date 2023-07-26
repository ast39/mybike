<?php

namespace App\Models;

use App\Http\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bike extends Model {

    use HasFactory, Filterable, SoftDeletes;


    protected $table      = 'bikes';

    protected $primaryKey = 'bike_id';

    protected $keyType    = 'int';


    public $incrementing  = true;

    public $timestamps    = true;


    /**
     * Владелец байка
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Производитель байка
     *
     * @return BelongsTo
     */
    public function mark(): BelongsTo
    {
        return $this->belongsTo(MotoMark::class, 'mark_id', 'mark_id');
    }

    /**
     * Сервисные работы
     *
     * @return HasMany
     */
    public function works(): HasMany
    {
        return $this->hasMany(Service::class, 'bike_id', 'bike_id')
            ->orderByDesc('created_at');
    }

    /**
     * Каталог запчастей на байк
     *
     * @return HasMany
     */
    public function catalog(): HasMany
    {
        return $this->hasMany(Article::class, 'bike_id', 'bike_id')
            ->orderByDesc('created_at');
    }

    /**
     * Заметки про байк
     *
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, 'bike_id', 'bike_id')
            ->orderByDesc('created_at');
    }

    /**
     * Сразу же просчитаем кол-во обслуживаний
     *
     * @return int
     */
    public function getVisitsAttribute(): int
    {
        return Service::where('bike_id', $this->bike_id)
            ->count() ?: 0;
    }

    /**
     * Сразу же просчитаем сколько потрачено на обслуживание
     *
     * @return int
     */
    public function getCashedAttribute(): int
    {
        return Service::where('bike_id', $this->bike_id)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }

    protected $with = [
        'mark',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected $fillable = [
        'bike_id', 'owner_id', 'mark_id', 'model', 'year', 'volume', 'vin', 'number', 'additional',
        'created_at', 'updated_at',
    ];

    protected $hidden = [
        'deleted_at',
    ];
}

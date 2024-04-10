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
     * Владелец
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Производитель
     *
     * @return BelongsTo
     */
    public function mark(): BelongsTo
    {
        return $this->belongsTo(BikeMark::class, 'mark_id', 'mark_id');
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
     * Каталог запчастей
     *
     * @return HasMany
     */
    public function catalog(): HasMany
    {
        return $this->hasMany(Article::class, 'bike_id', 'bike_id')
            ->orderByDesc('created_at');
    }

    /**
     * Заправки
     *
     * @return HasMany
     */
    public function gasoline(): HasMany
    {
        return $this->hasMany(Gas::class, 'bike_id', 'bike_id')
            ->orderByDesc('created_at');
    }

    /**
     * Платежи
     *
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'bike_id', 'bike_id')
            ->orderByDesc('created_at');
    }

    /**
     * Заметки
     *
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, 'bike_id', 'bike_id')
            ->orderByDesc('created_at');
    }

    /**
     * Сразу же просчитаем сколько потрачено на обслуживание
     *
     * @return int
     */
    public function getServiceExpensedAttribute(): int
    {
        return Service::where('bike_id', $this->bike_id)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }

    /**
     * Сразу же просчитаем сколько потрачено на топливо
     *
     * @return int
     */
    public function getFuelExpensedAttribute(): int
    {
        return Gas::where('bike_id', $this->bike_id)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }

    /**
     * Сразу же просчитаем сколько потрачено на налоги
     *
     * @return int
     */
    public function getTaxExpensedAttribute(): int
    {
        return Payment::where('bike_id', $this->bike_id)
            ->where('type_id', 1)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }

    /**
     * Сразу же просчитаем сколько потрачено на ОСАГО
     *
     * @return int
     */
    public function getOsagoExpensedAttribute(): int
    {
        return Payment::where('bike_id', $this->bike_id)
            ->where('type_id', 2)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }

    /**
     * Сразу же просчитаем сколько потрачено на КАСКО
     *
     * @return int
     */
    public function getKaskoExpensedAttribute(): int
    {
        return Payment::where('bike_id', $this->bike_id)
            ->where('type_id', 3)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }

    /**
     * Сразу же просчитаем сколько потрачено на штрафы
     *
     * @return int
     */
    public function getPenaltyExpensedAttribute(): int
    {
        return Payment::where('bike_id', $this->bike_id)
            ->where('type_id', 4)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }

    /**
     * Сразу же просчитаем сколько потрачено на мойки
     *
     * @return int
     */
    public function getWashingExpensedAttribute(): int
    {
        return Payment::where('bike_id', $this->bike_id)
            ->where('type_id', 5)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }

    /**
     * Сразу же просчитаем сколько потрачено на паркинг
     *
     * @return int
     */
    public function getParkingExpensedAttribute(): int
    {
        return Payment::where('bike_id', $this->bike_id)
            ->where('type_id', 6)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }

    /**
     * Сразу же просчитаем сколько потрачено на кредит
     *
     * @return int
     */
    public function getCreditExpensedAttribute(): int
    {
        return Payment::where('bike_id', $this->bike_id)
            ->where('type_id', 7)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }

    /**
     * Минимальный зафиксированный пробег автомобиля в истории
     *
     * @return int
     */
    public function getMinMileageAttribute(): int
    {
        $mileage = $this->collectAllMileages();
        if (count($mileage) < 1) {
            return 0;
        }

        return min($mileage) ?: 0;
    }

    /**
     * Максимальный зафиксированный пробег автомобиля в истории
     *
     * @return int
     */
    public function getMaxMileageAttribute(): int
    {
        $mileage = $this->collectAllMileages();
        if (count($mileage) < 1) {
            return 0;
        }

        return max($mileage) ?: 0;
    }

    /**
     * Итоговый пробег автомобиля в истории
     *
     * @return int
     */
    public function getBikeMileageAttribute(): int
    {
        $this->attributes['bike_mileage'] = $this->getMaxMileageAttribute() - $this->getMinMileageAttribute();
        return $this->getMaxMileageAttribute() - $this->getMinMileageAttribute();
    }

    /**
     * Стоимость 1км пробега
     *
     * @return float
     */
    public function getKmPriceAttribute(): float
    {
        return round(($this->getServiceExpensedAttribute()
                + $this->getFuelExpensedAttribute()
                + $this->getTaxExpensedAttribute()
                + $this->getOsagoExpensedAttribute()
                + $this->getKaskoExpensedAttribute()
                + $this->getPenaltyExpensedAttribute()
                + $this->getWashingExpensedAttribute()
                + $this->getParkingExpensedAttribute()
                + $this->getCreditExpensedAttribute())
            / max($this->getBikeMileageAttribute(), 1), 2);
    }

    /**
     * Заправки
     *
     * @return array
     */
    public function getFuelExpensesAttribute(): array
    {
        return Gas::where('bike_id', $this->bike_id)
            ->get()
            ->toArray();
    }


    /**
     * @return array
     */
    private function collectAllMileages(): array
    {
        if (!is_null($this->works())) {
            $works_mileage = array_filter(
                array_map(function ($e) {
                    return $e['mileage'];
                }, $this->works()
                    ->get()
                    ->toArray()), function($e) {
                        return !is_null($e);
                    }
                );
        }

        if (!is_null($this->gasoline())) {
            $gas_mileage = array_filter(
                array_map(function ($e) {
                    return $e['mileage'];
                }, $this->gasoline()
                    ->get()
                    ->toArray()), function($e) {
                return !is_null($e);
            }
            );
        }

        if (!is_null($this->notes())) {
            $notes_mileage = array_filter(
                array_map(function ($e) {
                    return $e['mileage'];
                }, $this->notes()
                    ->get()
                    ->toArray()), function($e) {
                        return !is_null($e);
                    }
                );
        }

        return array_unique(array_merge($works_mileage ?: [], $gas_mileage ?: [], $notes_mileage ?: []));
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

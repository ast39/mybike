<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class BikeFilter extends AbstractFilter {

    public const MARK  = 'mark';
    public const VIN   = 'vin';
    public const YEAR  = 'year';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [

            self::MARK => [$this, 'mark'],
            self::VIN  => [$this, 'vin'],
            self::YEAR => [$this, 'year'],
        ];
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function mark(Builder $builder, $value): void
    {
        $builder->where('mark_id', $value);
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function vin(Builder $builder, $value): void
    {
        $builder->where('vin', $value);
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function year(Builder $builder, $value): void
    {
        $builder->where('year', $value);
    }

}

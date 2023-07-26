<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ServiceFilter extends AbstractFilter {

    public const BIKE    = 'bike';
    public const SERVICE = 'service';
    public const STATUS  = 'status';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [

            self::BIKE    => [$this, 'bike'],
            self::SERVICE => [$this, 'service'],
            self::STATUS  => [$this, 'status'],
        ];
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function bike(Builder $builder, $value): void
    {
        $builder->where('bike_id', $value);
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function service(Builder $builder, $value): void
    {
        $builder->where('service_title', 'like', '%'. $value . '%');
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function status(Builder $builder, $value): void
    {
        $builder->where('status', $value);
    }

}

<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class PaymentFilter extends AbstractFilter {

    public const PERIOD_FROM = 'period_from';
    public const PERIOD_TO   = 'period_to';
    public const BIKE        = 'bike';
    public const TYPE        = 'type';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [

            self::PERIOD_FROM => [$this, 'periodFrom'],
            self::PERIOD_TO   => [$this, 'periodTo'],
            self::BIKE        => [$this, 'bike'],
            self::TYPE        => [$this, 'type'],
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
    public function type(Builder $builder, $value): void
    {
        $builder->where('type_id', $value);
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function periodFrom(Builder $builder, $value): void
    {
        $builder->where('created_at', '>=', $value);
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function periodTo(Builder $builder, $value): void
    {
        $builder->where('created_at', '<=', $value);
    }

}

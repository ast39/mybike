<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class NoteFilter extends AbstractFilter {

    public const PHRASE = 'phrase';
    public const BIKE    = 'bike';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [

            self::PHRASE => [$this, 'phrase'],
            self::BIKE    => [$this, 'bike'],
        ];
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function phrase(Builder $builder, $value): void
    {
        $builder->where('additional', 'like', '%' . $value . '%');
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

}

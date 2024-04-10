<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ClientFilter extends AbstractFilter {

    public const NAME = 'name';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
        ];
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function name(Builder $builder, $value): void
    {
        $builder->where('name', 'like', '%' . $value . '%');
    }

}

<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ArticleFilter extends AbstractFilter {

    public const BIKE    = 'bike';
    public const ARTICLE = 'article';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [

            self::BIKE    => [$this, 'bike'],
            self::ARTICLE => [$this, 'article'],
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
    public function article(Builder $builder, $value): void
    {
        $builder->where('article', $value);
    }

}

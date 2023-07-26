<?php

namespace App\Libs;

use App\Enums\WorkStatusEnum;

class Helper {

    /**
     * Полное наименование мотоцикла
     *
     * @param object|array $bike_data
     * @param bool $year
     * @return string
     */
    public static function bikeName(object|array $bike_data, bool $year = false): string
    {
        if (is_array($bike_data)) {
            return $bike_data['mark']['title'] . ' ' . $bike_data['model'] . ($year ? ' (' . $bike_data['year'] . ')' : '');
        }

        return $bike_data->mark->title . ' ' . $bike_data->model . ($year ? ' (' . $bike_data->year . ')' : '');
    }

    /**
     * Статус текстом
     *
     * @param int $status
     * @return string
     */
    public static function statusText(int $status): string
    {
        return match ($status) {

            WorkStatusEnum::Planned->value   => 'Запланировано',
            WorkStatusEnum::InWork->value    => 'В работе',
            WorkStatusEnum::Completed->value => 'Выполнено',

            default => 'В архиве',
        };
    }

    /**
     * Вывод пробега
     *
     * @param int|null $mileage
     * @return string
     */
    public static function mileage(?int $mileage): string
    {
        if (is_null($mileage)) {
            return ' - ';
        }

        return number_format($mileage, 0, '.', ' ') . ' км.';
    }
}

<?php

namespace App\Libs;

class GasolineHelper {

    /**
     * @param array $data
     * @return float
     */
    public static function minMileage(array $data): float
    {
        if (count($data) == 0) {
            return 0;
        }

        return min(
            array_map(function($e) {
                return $e['mileage'];
            }, $data)
        );
    }

    /**
     * @param array $data
     * @return float
     */
    public static function maxMileage(array $data): float
    {
        if (count($data) == 0) {
            return 0;
        }

        return max(
            array_map(function($e) {
                return $e['mileage'];
            }, $data)
        );
    }

    /**
     * @param array $data
     * @return float
     */
    public static function periodMileage(array $data): float
    {
        return self::maxMileage($data) - self::minMileage($data);
    }

    /**
     * @param array $data
     * @return float
     */
    public static function periodLiters(array $data): float
    {
        return array_sum(
            array_map(function($e) {
                return $e['volume'];
            }, $data)
        );
    }

    /**
     * @param array $data
     * @return float
     */
    public static function periodPrice(array $data): float
    {
        return array_sum(
            array_map(function($e) {
                return $e['price'];
            }, $data)
        );
    }

    /**
     * @param array $data
     * @return float
     */
    public static function avgLiterPrice(array $data): float
    {
        $period_price  = self::periodPrice($data);
        $period_liters = self::periodLiters($data);

        if ($period_price == 0 || $period_liters == 0) {
            return 0;
        }

        return round($period_price / $period_liters, 2);
    }

    /**
     * @param array $data
     * @return string
     */
    public static function avgLiterToKm(array $data): string
    {
        $period_liters  = self::periodLiters($data);
        $avg_gas_liters = self::avgGasLiters($data);
        $period_mileage = self::periodMileage($data);

        if ($period_mileage == 0) {
            return ' - ';
        }

        return number_format(round(($period_liters - $avg_gas_liters) / $period_mileage * 100, 2), 2, '.', ' ') . 'л.';
    }

    /**
     * @param array $data
     * @return float
     */
    public static function avgGasLiters(array $data): float
    {
        if (count($data) == 0) {
            return 0;
        }

        return self::periodLiters($data) / count($data);
    }

    /**
     * @param array $data
     * @return float
     */
    public static function avgGasPrice(array $data): float
    {
        if (count($data) == 0) {
            return 0;
        }

        return self::periodPrice($data) / count($data);
    }

}

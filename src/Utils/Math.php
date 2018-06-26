<?php
/**
 * Project Utils
 *
 * @category Class
 *
 * @file Math.php
 * @author loprym
 * @version 1.2
 *
 * @since 17.06.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;


class Math
{

    /**
     * Calculate average of array
     * @param array $values
     * @param int $precision
     * @return float
     */
    public static function arrayAverage(array $values, int $precision = 2): float
    {
        return self::average(\array_sum($values), \count($values), $precision);
    }

    /**
     * Calculate average
     * @param float $sum Sum of values
     * @param int $count
     * @param int $precision
     * @return float
     */
    public static function average(float $sum, int $count, int $precision = 2): float
    {
        return round(($sum / $count), $precision, PHP_ROUND_HALF_UP);
    }

    /**
     * Calculate median of array
     * @param array $values
     * @param int $precision
     * @return float
     */
    public static function arrayMedian(array $values, int $precision = 2): float
    {
        \sort($values, SORT_NUMERIC);

        $count = \count($values);

        $mid = (int)\floor($count / 2);

        $median = $values[$mid];
        if (self::isEven($count))
            $median = ($median + $values[$mid - 1]) / 2;

        return round($median, $precision, PHP_ROUND_HALF_UP);
    }

    /**
     * Is number Even?
     * @param int $num
     * @return bool
     */
    public static function IsEven(float $num): bool
    {
        return ($num % 2) ? false : true;
    }

    /**
     * Is number Odd
     * @param int $num
     * @return bool
     */
    public static function isOdd(float $num): bool
    {
        return !self::IsEven($num);
    }
}
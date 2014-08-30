<?php

namespace gabrielgeorgescu\math;

use yii\base\Widget;

class Math extends Widget
{

    const precision = 2;

    /**
     * Format number
     *
     * @param number $number
     * @param string $dDelimiter Decimal delimiter
     * @param null $precision number of decimals
     * @param string $tDelimiter Thousand delimiter
     * @return string
     */
    public static function formatNumber($number, $precision = null, $dDelimiter = '.', $tDelimiter = ',')
    {
        if ($precision === null) {
            $precision = static::precision;
        }

        return number_format($number, $precision, $dDelimiter, $tDelimiter);
    }

    /**
     * Returns the sum of two numbers
     *
     * @param number $s1
     * @param number $s2
     * @param null $precision
     * @return mixed
     */
    public static function SumTwo($s1, $s2, $precision = null)
    {
        return static::formatNumber($s1 + $s2, $precision);
    }

    /**
     * Returns the sum of n numbers
     *
     * @param array $number
     * @param null $precision
     * @return string
     */
    public static function Sum($number = [], $precision = null)
    {
        $sum = 0;
        foreach ($number as $n) {
            $sum = static::SumTwo($sum, $n);
        }
        return static::formatNumber($sum, $precision);
    }

    /**
     * Returns decrease of two numbers
     *
     * @param number $s1
     * @param number $s2
     * @param null $precision
     * @param bool $revert
     * @param bool $absolute
     * @return number
     */
    public static function SubtractTwo($s1, $s2, $precision = null, $revert = false, $absolute = false)
    {
        if ($revert) {
            if ($absolute) {
                return static::formatNumber(abs($s2 - $s1), $precision);
            }
            return static::formatNumber($s2 - $s1, $precision);
        }
        if ($absolute) {
            return static::formatNumber(abs($s1 - $s2), $precision);
        }
        return static::formatNumber($s1 - $s2, $precision);
    }

    /**
     * Returns decrease of n numbers
     *
     * @param array $number
     * @param null $precision
     * @param bool $revert
     * @param bool $absolute
     * @return string
     */
    public static function Subtract($number = [], $precision = null, $revert = false, $absolute = false)
    {
        if ($revert) {
            $number = array_reverse($number);
        }
        $diff = $number[0];
        foreach ($number as $n) {
            $diff = static::SubtractTwo($diff, $n);
        }
        if ($absolute) {
            return static::formatNumber(abs($diff), $precision);
        }
        return static::formatNumber($diff, $precision);
    }

    /**
     * Returns the multiplication of two numbers
     *
     * @param number $n1
     * @param number $n2
     * @param null $precision
     * @param bool $absolute
     * @return string
     */
    public static function MultipleTwo($n1, $n2, $precision = null, $absolute = false)
    {
        if ($absolute) {
            return static::formatNumber(abs($n1 * $n2),$precision);
        }
        return static::formatNumber($n1 * $n2, $precision);
    }

    /**
     * Returns the multiplication of n numbers
     *
     * @param array $numbers
     * @param null $precision
     * @param bool $absolute
     * @return string
     */
    public static function Multiple($numbers = [], $precision = null, $absolute = false)
    {
        $multiple = 1;
        foreach ($numbers as $n) {
            $multiple = static::MultipleTwo($multiple, $n);
        }
        if ($absolute) {
            return static::formatNumber(abs($multiple), $precision);
        }
        return static::formatNumber($multiple, $precision);
    }

    /**
     * Return value after subtract percent
     *
     * @param number $number
     * @param number $percent
     * @param null $precision
     * @return string
     */
    public static function SubtractPercent($number, $percent, $precision = null)
    {
        $percent = $percent / 100;
        $percent = 1 - $percent;

        return static::MultipleTwo($number, $percent, $precision);
    }

    /**
     * Return value after add percent
     *
     * @param number $number
     * @param number $percent
     * @param null $precision
     * @return string
     */
    public static function AddPercent($number, $percent, $precision = null)
    {
        $percent = $percent / 100;
        $percent = 1 + $percent;

        return static::MultipleTwo($number, $percent, $precision);
    }

    /**
     * Return value of factorial
     *
     * @param number $number
     * @param null $precision
     * @return string
     */
    public static function Factorial($number, $precision = null)
    {
        return static::formatNumber(gmp_fact($number), $precision);
    }
}

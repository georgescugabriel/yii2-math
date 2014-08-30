<?php

namespace gabrielgeorgescu\math;

use yii\base\Widget;

class Math extends Widget
{

    const precision = 2;

    /**
     * Format number
     *
     * @param $number
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
     * @param $s1 number
     * @param $s2 number
     * @return mixed
     */
    public static function SumTwo($s1, $s2)
    {
        return static::formatNumber($s1 + $s2);
    }

    /**
     * Returns the sum of n numbers
     *
     * @param array $number
     * @return int
     */
    public static function Sum($number = [])
    {
        $sum = 0;
        foreach ($number as $n) {
            $sum = static::SumTwo($sum, $n);
        }
        return static::formatNumber($sum);
    }

    /**
     * Returns decrease of two numbers
     *
     * @param $s1
     * @param $s2
     * @param bool $revert
     * @param bool $absolute
     * @return number
     *
     */
    public static function SubtractTwo($s1, $s2, $revert = false, $absolute = false)
    {
        if ($revert) {
            if ($absolute) {
                return static::formatNumber(abs($s2 - $s1));
            }
            return static::formatNumber($s2 - $s1);
        }
        if ($absolute) {
            return static::formatNumber(abs($s1 - $s2));
        }
        return static::formatNumber($s1 - $s2);
    }

    /**
     * Returns decrease of n numbers
     *
     * @param array $number
     * @param bool $revert
     * @param bool $absolute
     * @return string
     */
    public static function Subtract($number = [], $revert = false, $absolute = false)
    {
        if ($revert) {
            $number = array_reverse($number);
        }
        $diff = $number[0];
        foreach ($number as $n) {
            $diff = static::SubtractTwo($diff, $n);
        }
        if ($absolute) {
            return static::formatNumber(abs($diff));
        }
        return static::formatNumber($diff);
    }

    /**
     * Returns the multiplication of two numbers
     *
     * @param $n1
     * @param $n2
     * @param bool $absolute
     * @return string
     */
    public static function MultipleTwo($n1, $n2, $absolute = false)
    {
        if ($absolute) {
            return static::formatNumber(abs($n1 * $n2));
        }
        return static::formatNumber($n1 * $n2);
    }

    /**
     * Returns the multiplication of n numbers
     *
     * @param array $numbers
     * @param bool $absolute
     * @return string
     */
    public static function Multiple($numbers = [], $absolute = false)
    {
        $multiple = 1;
        foreach ($numbers as $n) {
            $multiple = static::MultipleTwo($multiple, $n);
        }
        if ($absolute) {
            return static::formatNumber(abs($multiple));
        }
        return static::formatNumber($multiple);
    }

    /**
     * Return value after subtract percent
     *
     * @param $number
     * @param $percent
     * @return string
     */
    public static function SubtractPercent($number, $percent)
    {
        $percent = $percent / 100;
        $percent = 1 - $percent;

        return static::MultipleTwo($number, $percent);
    }

    /**
     * Return value after add percent
     *
     * @param $number
     * @param $percent
     * @return string
     */
    public static function AddPercent($number, $percent)
    {
        $percent = $percent / 100;
        $percent = 1 + $percent;

        return static::MultipleTwo($number, $percent);
    }

    /**
     * Return value of factorial
     *
     * @param $number
     * @return string
     */
    public static function Factorial($number)
    {
        return static::formatNumber(gmp_fact($number));
    }
}

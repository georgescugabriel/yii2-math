<?php

namespace gabrielgeorgescu\math;

use yii\base\Widget;

class Math extends Widget
{

    //params
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
    public static function formatNumber($number, $dDelimiter = '.', $precision = null, $tDelimiter = ',')
    {
        if (!$precision) {
            $precision = static::precision;
        }

        return number_format($number, $precision, $dDelimiter, $tDelimiter);
    }

    /**
     * Return sum between two numbers
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
     * Return sum between n number
     *
     * @param array $number
     * @return int
     */
    public static function Sum($number = [])
    {
        $sum = 0;
        foreach ($number as $n) {
            $sum += $n;
        }
        return static::formatNumber($sum);
    }

    /**
     * Return subtract between two numbers
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
     * Return subtract between n numbers
     *
     * @param array $number
     * @param bool $revert
     * @param bool $absolute
     * @return string
     */
    public static function Subtract($number = [], $revert = false, $absolute = false)
    {
        if($revert){
            $number = array_reverse($number);
        }
        $diff = $number[0];
        foreach($number as $n){
            $diff-=$n;
        }
        if($absolute){
            return static::formatNumber(abs($diff));
        }
        return static::formatNumber($diff);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 06.11.2018
 * Time: 16:56
 */

namespace esas\cmsgate\utils;


class StringUtils
{
    static function compare($string1, $string2)
    {
        return strcmp(trim($string1), trim($string2)) == 0;
    }

    static function substrBetween($string, $from, $to)
    {
        if (is_int($from) && is_int($to)) { // если substring между позициями
            $startIndex = min($from, $to);
            $length = abs($from - $to);
            return substr($string, $startIndex, $length);
        } else { // если substring между строками
            $string = ' ' . $string;
            if ($from == '')
                $ini = 1;
            else
                $ini = strpos($string, $from);
            if ($ini == 0) return '';
            $ini += strlen($from);
            $len = strpos($string, $to, $ini) - $ini;
            return substr($string, $ini, $len);
        }
    }

    static function substrBefore($string, $to)
    {
        if (is_int($to))
            return self::substrBetween($string, 0, $to);
        else
            return self::substrBetween($string, "", $to);
    }

    /**
     * @param $format
     * @param $data
     * @return string
     */
    static function format($format, $data)
    {
        return str_replace(array_keys($data), array_values($data), $format);
    }

    static function isNullOrEmptyString($str){
        return (!isset($str) || trim($str) === '');
    }
}
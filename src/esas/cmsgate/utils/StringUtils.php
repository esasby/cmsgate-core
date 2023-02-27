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
            $length = abs($from - $to) - 1;
            return substr($string, $startIndex, $length);
        } else { // если substring между строками
            if (!is_int($from)) {
                $start = strpos($string, $from);
                if ($start > 0)
                    $start += strlen($from);
            } else
                $start = $from;
            $toPosition = strpos($string, $to, $start);
            if ($toPosition === 0)
                $len = 0;
            elseif ($toPosition > 0)
                $len = $toPosition - $start;
            else
                $len = strlen($string);
            return substr($string, $start, $len);
        }
    }

    static function substrBefore($string, $to, $start = 0)
    {
        if (is_int($to))
            return self::substrBetween($string, $start, $to);
        else
            return self::substrBetween($string, $start, $to);
    }

    static function substrAfter($string, $after)
    {
        $afterPos = strpos($string, $after);
        if ($afterPos == 0)
            return "";
        else
            return substr($string, $afterPos + 1, strlen($string));
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

    static function isNullOrEmptyString($str)
    {
        return (!isset($str) || trim($str) === '');
    }

    static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if (!$length) {
            return true;
        }
        return substr($haystack, -$length) === $needle;
    }

    static function contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false ;
    }

    static function guidv4($data = null)
    {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
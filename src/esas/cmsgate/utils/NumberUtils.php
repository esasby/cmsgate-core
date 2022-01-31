<?php


namespace esas\cmsgate\utils;


class NumberUtils
{
    /**
     * @param $number
     * @return bool
     */
    public static function hasDecimalPart($number) {
        return self::getDecimalPart($number) > 0;
    }

    public static function getDecimalPart($number) {
        if (!is_numeric($number))
            return 0;
        $pointPos = strpos($number, ".");
        if ($pointPos <=0 )
            return 0;
        $decimalPart = substr($number, $pointPos + 1, strlen($number));
        return intval($decimalPart);
    }

    public static function formatDecimalWithDelimiter($decimal, $delimiter) {
        return floatval(preg_replace(["/\./", "/\,/"], $delimiter, strval($decimal)));
    }

    public static function formatDecimalWithComma($decimal) {
        return self::formatDecimalWithDelimiter($decimal, ',');
    }

    public static function formatDecimalWithPoint($decimal) {
        return self::formatDecimalWithDelimiter($decimal, '.');
    }
}
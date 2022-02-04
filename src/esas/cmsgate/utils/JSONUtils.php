<?php


namespace esas\cmsgate\utils;


class JSONUtils
{
    public static function encodePretty($data) {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public static function encodeArrayAndMask($date, $fieldsToMask) {
        $maskedArray = ArrayUtils::maskValues($date, $fieldsToMask);
        return self::encodePretty($maskedArray);
    }
}
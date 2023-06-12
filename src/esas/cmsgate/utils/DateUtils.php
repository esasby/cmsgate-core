<?php


namespace esas\cmsgate\utils;


use DateTime;

class DateUtils
{
    /**
     * @param $dataTime DateTime
     * @param $format string
     * @return null
     */
    public static function formatNotNull($dataTime, $format) {
        return $dataTime != null ? $dataTime->format($format) : null;
    }
}
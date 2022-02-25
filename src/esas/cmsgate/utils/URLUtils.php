<?php


namespace esas\cmsgate\utils;


class URLUtils
{
    public static function getCurrentURL() {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public static function getCurrentURLNoParams() {
        return StringUtils::substrBefore(self::getCurrentURL(), "?");
    }

    public static function getCurrentURLMainPart() {
        $mainPart = "/" . StringUtils::substrBefore($_SERVER['REQUEST_URI'], "/", 1);
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$mainPart";
    }
}
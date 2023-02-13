<?php


namespace esas\cmsgate\utils;


class RequestUtils
{
    public static function getRequestPath() {
        return $_SERVER['REDIRECT_URL'];
    }

    public static function isMethodPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public static function isMethodDelete() {
        return $_SERVER['REQUEST_METHOD'] == 'DELETE';
    }
}
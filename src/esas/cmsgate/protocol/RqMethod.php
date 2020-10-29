<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 21.01.2019
 * Time: 17:57
 */

namespace esas\cmsgate\protocol;


class RqMethod
{
    const _GET = 0;
    const _POST = 1;
    const _DELETE = 2;
    const _PUT = 3;

    public static function toString($rqMethod) {
        switch ($rqMethod) {
            case self::_GET:
                return "GET";
            case self::_POST:
                return "POST";
            case  self::_DELETE:
                return "DELETE";
            case  self::_PUT:
                return "PUT";
            default:
                return "UNKNOWN";
        }
    }
}
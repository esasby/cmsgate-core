<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 27.08.2020
 * Time: 11:44
 */

namespace esas\cmsgate\utils;


use esas\cmsgate\Registry;

class EncodingUtils
{
    static function convertToUtf8($string) {
        return mb_convert_encoding($string, "utf-8", Registry::getRegistry()->getCmsConnector()->getCurrentEncoding());
    }

    static function convertFromUtf8($string) {
        return mb_convert_encoding($string, Registry::getRegistry()->getCmsConnector()->getCurrentEncoding(), "utf-8");
    }
}
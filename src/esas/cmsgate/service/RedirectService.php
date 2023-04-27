<?php
namespace esas\cmsgate\service;

use esas\cmsgate\utils\URLUtils;

class RedirectService
{
    public static function redirect($location) {
        header('Location: '. $location);
        die();
    }

    public static function returnAbsolutePathOrRedirect($relativePath, $sendHeader = false) {
        $location = URLUtils::getCurrentURLMainPart() . $relativePath;
        if ($sendHeader)
            self::redirect($location);
        return $location;
    }
}
<?php
namespace esas\cmsgate\service;

use esas\cmsgate\Registry;
use esas\cmsgate\utils\URLUtils;

class RedirectService extends Service
{
    /**
     * @return $this
     * @throws \esas\cmsgate\utils\CMSGateException
     */
    public static function fromRegistry() {
        return Registry::getRegistry()->getService(RedirectService::class);
    }

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
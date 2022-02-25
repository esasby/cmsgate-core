<?php


namespace esas\cmsgate\utils\htmlbuilder\presets;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class ScriptsPreset
{
    public static function elementScript($src) {
        return element::script(
            attribute::src($src)
        );
    }

    public static function elementScriptJquery3Min() {
        return self::elementScript("https://code.jquery.com/jquery-3.5.1.min.js");
    }

    public static function elementScriptBootstrap4Min() {
        return self::elementScript("https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js");
    }

    public static function elementScriptPopper1Min() {
        return self::elementScript("https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js");
    }
}
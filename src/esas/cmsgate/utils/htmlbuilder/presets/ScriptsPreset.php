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

    public static function elementScriptBootstrap5Min() {
        return self::elementScript("https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js");
    }

    public static function elementScriptBootstrapMin() {
        return BootstrapPreset::isBootstrapV4() ? self::elementScriptBootstrap4Min() : self::elementScriptBootstrap5Min();
    }

    public static function elementScriptPopper1Min() {
        return self::elementScript("https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js");
    }

    public static function elementScriptGoogleRecaptcha() {
        return self::elementScript("https://www.google.com/recaptcha/api.js");
    }

    public static function elementScriptClickableTable() {
        return element::scriptFile(dirname(__FILE__) . "/js/clickableTable.js");;
    }

    public static function elementScriptCopyToClipboard() {
        return element::scriptFile(dirname(__FILE__) . "/js/copyToClipboard.js");;
    }

    public static function elementScriptGoogleRecaptchaSubmit() {
        return element::scriptFile(dirname(__FILE__) . "/js/googleRecaptchaSubmit.js");;
    }

    public static function elementScriptBootstrapInputSpinner() {
        return element::scriptFile(dirname(__FILE__) . "/js/bootstrap-input-spinner.js");;
    }

    public static function elementScriptMultiply() {
        return element::scriptFile(dirname(__FILE__) . "/js/multiply.js");
    }

    public static function elementScriptBasketTotal() {
        return element::scriptFile(dirname(__FILE__) . "/js/basketTotal.js");
    }
}
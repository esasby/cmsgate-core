<?php


namespace esas\cmsgate\utils\htmlbuilder\presets;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class CssPreset
{
    public static function elementHeadLinkStylesheet($href) {
        return element::link(
            attribute::href($href),
            attribute::rel("stylesheet"));
    }

    public static function elementLinkCssBootstrap4Min() {
        return self::elementHeadLinkStylesheet("https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css");
    }

    public static function elementLinkCssFontAwesome4Min() {
        return self::elementHeadLinkStylesheet("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
    }

    public static function elementLinkCssGoogleFonts($point) {
        return self::elementHeadLinkStylesheet("https://fonts.googleapis.com/" . $point);
    }
}
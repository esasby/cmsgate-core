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

    public static function elementLinkCssBootstrapMin() {
        return BootstrapPreset::isBootstrapV4() ? self::elementLinkCssBootstrap4Min() : self::elementLinkCssBootstrap5Min();
    }

    public static function elementLinkCssBootstrap4Min() {
        return self::elementHeadLinkStylesheet("https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css");
    }

    public static function elementLinkCssBootstrap5Min() {
        return self::elementHeadLinkStylesheet("https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css");
    }

    public static function elementLinkCssFontAwesome4Min() {
        return self::elementHeadLinkStylesheet("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
    }

    public static function elementLinkCssGoogleFonts($point) {
        return self::elementHeadLinkStylesheet("https://fonts.googleapis.com/" . $point);
    }

    public static function elementAccordionV1() {
        return element::styleFile(dirname(__FILE__) . "/css/accordion_v1.css");
    }
}
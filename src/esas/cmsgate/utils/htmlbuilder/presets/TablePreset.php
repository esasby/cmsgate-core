<?php

namespace esas\cmsgate\utils\htmlbuilder\presets;

use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class TablePreset
{
    public static function elementTableClickable(...$elementAndAttributes) {
        return element::table(
            $elementAndAttributes
        ) . ScriptsPreset::elementScriptClickableTable();
    }

    public static function elementTdSwitch($checked) {
        return element::div(
                attribute::clazz("form-check form-switch"),
                element::input(
                    attribute::clazz("form-check-input"),
                    attribute::type("checkbox"),
                    attribute::checked($checked),
                    attribute::disabled(true)
                )
            );
    }

    public static function elementTdStretchedLink($label, $href) {
        return element::a(
            attribute::clazz("stretched-link text-decoration-none"),
            attribute::href($href),
            element::content($label)
        );
    }

    public static function elementTrClickable($href, ...$elementAndAttributes) {
        return element::tr(
            attribute::clazz("clickable-row"),
            attribute::data_href($href),
            $elementAndAttributes
        );
    }
}
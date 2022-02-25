<?php


namespace esas\cmsgate\utils\htmlbuilder\presets;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class CommonPreset
{
    public static function elementATop($class, $label)
    {
        return element::a(
            attribute::clazz($class),
            attribute::href('#'),
            element::content($label)
        );
    }

    public static function elementNavBarList(...$elements)
    {
        return element::ul(
            attribute::clazz("navbar-nav mr-auto"),
            $elements);
    }

    public static function elementNavBarListItem($href, $label, $active = false)
    {
        return element::li(
            attribute::clazz("nav-item" . ($active ? " active" : "")),
            element::a(
                attribute::clazz("nav-link"),
                attribute::href($href),
                $label
            )
        );
    }
}
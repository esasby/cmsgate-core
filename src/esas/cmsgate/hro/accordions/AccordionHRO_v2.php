<?php


namespace esas\cmsgate\hro\accordions;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\CssPreset;

class AccordionHRO_v2 extends AccordionHRO_v1
{
    public static function builder() {
        return new AccordionHRO_v2();
    }

    public function build() {
        return element::div(
            attribute::id($this->id),
            attribute::clazz('accordion'),
            CssPreset::elementAccordionV1(),
            $this->tabs);
    }
}
<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\accordions;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class AccordionHRO_v1 implements AccordionHRO
{
    protected $id;
    protected $tabs;

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function addTab($tab) {
        $this->tabs[] = $tab;
        return $this;
    }

    public static function builder() {
        return new AccordionHRO_v1();
    }

    public function build() {
        return element::div(
            attribute::id($this->id),
            attribute::clazz('accordion'),
            $this->tabs);
    }
}
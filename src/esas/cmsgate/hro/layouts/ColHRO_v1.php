<?php


namespace esas\cmsgate\hro\layouts;

use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class ColHRO_v1 implements ColHRO
{
    protected $verticalAlignment;
    protected $elements;

    /**
     * @inheritDoc
     */
    public function setVerticalAlignment($verticalAlignment) {
        $this->verticalAlignment = 'align-self-' . $verticalAlignment;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addElement($element) {
        $this->elements[] = $element;
        return $this;
    }


    public static function builder() {
        return new ColHRO_v1();
    }

    public function build() {
        return element::div(
            attribute::clazz('col ' . $this->verticalAlignment),
            $this->elements
        );
    }
}
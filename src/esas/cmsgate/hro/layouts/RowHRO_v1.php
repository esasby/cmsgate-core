<?php


namespace esas\cmsgate\hro\layouts;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class RowHRO_v1 implements RowHRO
{
    protected $horizontalAlignment;
    protected $verticalAlignment;
    protected $elements;

    /**
     * @inheritDoc
     */
    public function setHorizontalAlignment($horizontalAlignment) {
        $this->horizontalAlignment = 'justify-content-' . $horizontalAlignment;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setVerticalAlignment($verticalAlignment) {
        $this->verticalAlignment = 'align-items-' . $verticalAlignment;
        return $this;
    }

    /**
     * @param mixed $element
     * @return RowHRO_v1
     */
    public function addElement($element) {
        $this->elements[] = $element;
        return $this;
    }

    public static function builder() {
        return new RowHRO_v1();
    }

    public function build() {
        return element::div(
            attribute::clazz('row ' . $this->horizontalAlignment . ' ' . $this->verticalAlignment),
            $this->elements
        );
    }
}
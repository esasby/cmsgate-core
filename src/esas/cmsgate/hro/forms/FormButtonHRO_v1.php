<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class FormButtonHRO_v1 implements FormButtonHRO
{
    protected $type;
    protected $onClick;
    protected $label;

    /**
     * @inheritDoc
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setOnClick($onClick) {
        $this->onClick = $onClick;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLabel($label, $translate = true) {
        $this->label = $translate ? Translator::fromRegistry()->translate($label) : $label;
        return $this;
    }

    public static function builder() {
        return new FormButtonHRO_v1();
    }

    public function build() {
        return element::button(
            attribute::type($this->type),
//            attribute::role("group"),
            attribute::onclick($this->onClick),
            attribute::clazz("btn btn-secondary"),
            element::content($this->label)
        );
    }
}
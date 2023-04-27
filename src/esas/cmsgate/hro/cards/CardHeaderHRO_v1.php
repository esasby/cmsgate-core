<?php


namespace esas\cmsgate\hro\cards;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;

/**
 * Label is on the left, buttons is on the right
 * @package esas\cmsgate\hro\cards
 */
class CardHeaderHRO_v1 implements CardHeaderHRO
{
    public static function builder() {
        return new CardHeaderHRO_v1();
    }

    protected $label;

    protected $elementCardButtons;

    public function setLabel($label, $translate = true) {
        $this->label = $translate ? Translator::fromRegistry()->translate($label) : $label;
        return $this;
    }


    public function addButton($label, $href, $classAppend, $translateLabel = false) {
        $this->elementCardButtons .= bootstrap::elementAButton($translateLabel ? Translator::fromRegistry()->translate($label) : $label, $href, $classAppend);
        return $this;
    }

    public function build() {
        return
            element::div(
                attribute::clazz('d-flex'),
                element::div(
                    attribute::clazz('d-flex-grow-1'),
                    $this->label //todo add top padding
                ),
                $this->elementCardButtons
            );
    }
}
<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\cards;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\htmlbuilder\hro\HRO;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;

class CardButtonsRowHRO implements HRO
{

    public static function builder() {
        return new CardButtonsRowHRO();
    }

    protected $elementFooterButtons;

    public function addButtonI18n($label, $href, $classAppend) {
        return $this->addButton(Translator::fromRegistry()->translate($label), $href, $classAppend);
    }

    public function addButton($label, $href, $classAppend) {
        $this->elementFooterButtons .= bootstrap::elementCardFooterButton($label, $href, $classAppend);
        return $this;
    }

    public function build() {
        return bootstrap::elementCardFooterButtons(
            $this->elementFooterButtons
        );
    }
}
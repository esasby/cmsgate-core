<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\cards;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\htmlbuilder\hro\HRO;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;

class CardButtonHRO implements HRO
{
    private $label;
    private $href;
    private $classAppend;

    /**
     * @param mixed $label
     * @return CardButtonHRO
     */
    public function setLabel($label, $translate = false) {
        if ($translate)
            $this->label = Translator::fromRegistry()->translate($label);
        else
            $this->label = $label;
        return $this;
    }

    /**
     * @param mixed $href
     * @return CardButtonHRO
     */
    public function setHref($href) {
        $this->href = $href;
        return $this;
    }

    /**
     * @param mixed $classAppend
     * @return CardButtonHRO
     */
    public function setClassAppend($classAppend) {
        $this->classAppend = $classAppend;
        return $this;
    }

    public static function builder() {
        return new CardButtonHRO();
    }

    public function build() {
        return bootstrap::elementAButton($this->label, $this->href, $this->classAppend);
    }
}
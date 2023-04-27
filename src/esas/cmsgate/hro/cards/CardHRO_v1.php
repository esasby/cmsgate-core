<?php


namespace esas\cmsgate\hro\cards;

use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;

class CardHRO_v1 implements CardHRO
{
    protected $cardHeader;
    protected $cardBody;
    protected $cardFooter;

    /**
     * @param mixed $cardHeader
     * @param bool $translate
     * @return CardHRO_v1
     */
    public function setCardHeader($cardHeader, $translate = true) {
        $this->cardHeader = $translate ? Translator::fromRegistry()->translate($cardHeader) : $cardHeader;
        return $this;
    }
    /**
     * @param mixed $cardBody
     * @return CardHRO_v1
     */
    public function setCardBody($cardBody) {
        $this->cardBody = $cardBody;
        return $this;
    }

    /**
     * @param mixed $cardFooter
     * @return CardHRO_v1
     */
    public function setCardFooter($cardFooter) {
        $this->cardFooter = $cardFooter;
        return $this;
    }


    public function build() {
        return bootstrap::elementCard(
            $this->cardHeader != null ? bootstrap::elementCardHeader($this->cardHeader) : '',
            bootstrap::elementCardBody($this->cardBody),
            $this->cardFooter != null ? bootstrap::elementCardFooter($this->cardFooter) : ''
        );
    }

    public static function builder() {
        return new CardHRO_v1();
    }
}
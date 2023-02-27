<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\cards;

use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;
use esas\cmsgate\utils\htmlbuilder\hro\HRO;

class CardHRO implements HRO
{
    protected $cardHeader;
    protected $cardBody;
    protected $cardFooter;

    /**
     * @param mixed $cardHeader
     * @return CardHRO
     */
    public function setCardHeader($cardHeader) {
        $this->cardHeader = $cardHeader;
        return $this;
    }

    public function setCardHeaderI18n($headerLabel) {
        return $this->setCardHeader(Translator::fromRegistry()->translate($headerLabel));
    }

    /**
     * @param mixed $cardBody
     * @return CardHRO
     */
    public function setCardBody($cardBody) {
        $this->cardBody = $cardBody;
        return $this;
    }

    /**
     * @param mixed $cardFooter
     * @return CardHRO
     */
    public function setCardFooter($cardFooter) {
        $this->cardFooter = $cardFooter;
        return $this;
    }


    public function build() {
        return bootstrap::elementCard(
            bootstrap::elementCardHeader($this->elementCardHeader()),
            bootstrap::elementCardBody($this->elementCardBody()),
            bootstrap::elementCardFooter($this->elementCardFooter())
        );
    }

    public function elementCardHeader() {
        return $this->cardHeader;
    }

    public function elementCardBody() {
        return $this->cardBody;
    }

    public function elementCardFooter() {
        return $this->cardFooter;
    }

    public static function builder() {
        return new CardHRO();
    }
}
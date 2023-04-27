<?php

namespace esas\cmsgate\hro\pages;

use esas\cmsgate\lang\Translator;
use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;
use esas\cmsgate\view\client\ClientViewFields;
use esas\cmsgate\wrappers\OrderWrapper;

class ClientOrderCompletionPageHRO_v1 extends ClientPageHRO implements ClientOrderCompletionPageHRO
{
    /**
     * @var OrderWrapper
     */
    protected $orderWrapper;

    protected $elementCompletionPanel;

    /**
     *
     * @param OrderWrapper $orderWrapper
     */
    public function __construct($orderWrapper = null, $elementCompletionPanel = null) {
        parent::__construct();
        $this->orderWrapper = $orderWrapper;
        $this->elementCompletionPanel = $elementCompletionPanel;
    }

    public function setOrderWrapper($orderWrapper) {
        $this->orderWrapper = $orderWrapper;
        return $this;
    }

    public function setElementCompletionPanel($elementCompletionPanel) {
        $this->elementCompletionPanel = $elementCompletionPanel;
        return $this;
    }

    public function getPageTitle() {
        return Translator::fromRegistry()->translate(ClientViewFields::COMPLETION_PAGE_TITLE);
    }

    public function getElementSectionHeaderTitle() {
        return Translator::fromRegistry()->translate(ClientViewFields::COMPLETION_PAGE_HEADER);
    }

    public function getElementSectionHeaderDetails() {
        return !$this->isErrorPage() ?
            Translator::fromRegistry()->translate(ClientViewFields::COMPLETION_PAGE_HEADER_DETAILS) :
            Translator::fromRegistry()->translate(ClientViewFields::COMPLETION_ERROR_PAGE_HEADER_DETAILS);
    }

    public function elementPageContent() {
        return $this->elementCompletionPanel
            . element::br()
            . $this->elementReturnToShopButton()
            . element::br();
    }

    public function elementPageErrorContent() {
        return $this->elementReturnToShopButton()
            . element::br();
    }

//    public function elementErrorMessages()
//    {
//        $messages = "";
//        foreach (Registry::getRegistry()->getMessenger()->getErrorMessagesArray() as $errorText) {
//            $messages .= $this->elementErrorMessage($errorText);
//        }
//        return element::div(
//            attribute::clazz("alert alert-danger"),
//            attribute::role("alert"),
//            element::h4(
//                attribute::clazz("alert-heading"),
//                Translator::fromRegistry()->translate(ClientViewFields::ERROR)
//            ),
//            element::p(
//                $this->getErrorSorryText()
//            ),
//            element::hr(),
//            element::p(
//                Registry::getRegistry()->getMessenger()->getErrorMessages()
//            )
//        );
//    }

    public function elementErrorMessage($errorText) {
        return element::p(
            $errorText
        );
    }

    public function getErrorSorryText() {
        return Translator::fromRegistry()->translate(ClientViewFields::ERROR_APOLOGIZING);
    }

    public function elementReturnToShopButton() {
        return element::div(
            attribute::clazz("row justify-content-end"),
            bootstrap::elementDiv("col-md-2",
                element::a(
                    attribute::href($this->getReturnToShopButtonHref()),
                    attribute::clazz($this->getReturnToShopButtonClass()),
                    element::span(
                        $this->getReturnToShopButtonLabel()
                    )
                )
            )
        );
    }

    public function getReturnToShopButtonHref() {
        return $this->isErrorPage() ?
            Registry::getRegistry()->getCmsConnector()->getReturnToShopFailedURL()
            : Registry::getRegistry()->getCmsConnector()->getReturnToShopSuccessURL();
    }

    public function getReturnToShopButtonClass() {
        return "btn col-12 me-1 " . ($this->isErrorPage() ? "btn-outline-danger" : "btn-outline-success");
    }

    public function getReturnToShopButtonLabel() {
        return Translator::fromRegistry()->translate(ClientViewFields::COMPLETION_PAGE_RETURN_TO_SHOP_BUTTON);
    }

    public static function builder() {
        return new ClientOrderCompletionPageHRO_v1();
    }

}
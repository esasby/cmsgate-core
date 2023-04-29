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
        switch ($this->orderWrapper->getStatus()->getOrderStatus()) {
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusPayed():
                $msg = ClientViewFields::COMPLETION_PAGE_ORDER_PAYED_HEADER;
                break;
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusFailed():
                $msg = ClientViewFields::COMPLETION_PAGE_ORDER_FAILED_HEADER;
                break;
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusCanceled():
                $msg = ClientViewFields::COMPLETION_PAGE_ORDER_CANCELED_HEADER;
                break;
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusPending():
            default:
                $msg = ClientViewFields::COMPLETION_PAGE_ORDER_PENDING_HEADER;
                break;
        }
        return Translator::fromRegistry()->translate($msg);
    }

    public function getElementSectionHeaderDetails() {
        if ($this->isErrorPage())
            return Translator::fromRegistry()->translate(ClientViewFields::COMPLETION_ERROR_PAGE_HEADER_DETAILS);
        switch ($this->orderWrapper->getStatus()->getOrderStatus()) {
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusPayed():
                $msg = ClientViewFields::COMPLETION_PAGE_ORDER_PAYED_HEADER_DETAILS;
                break;
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusFailed():
                $msg = ClientViewFields::COMPLETION_PAGE_ORDER_FAILED_HEADER_DETAILS;
                break;
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusCanceled():
                $msg = ClientViewFields::COMPLETION_PAGE_ORDER_CANCELED_HEADER_DETAILS;
                break;
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusPending():
            default:
                $msg = ClientViewFields::COMPLETION_PAGE_ORDER_PENDING_HEADER_DETAILS;
                break;
        }
        return Translator::fromRegistry()->translate($msg);
    }

    public function elementPageContent() {
        return $this->elementOrderStatusOrCompletionPanel()
            . element::br()
            . $this->elementReturnToShopButton()
            . element::br();
    }

    public function elementOrderStatusOrCompletionPanel() {
        switch ($this->orderWrapper->getStatus()->getOrderStatus()) {
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusPayed():
                $alert = ClientViewFields::COMPLETION_PAGE_ORDER_PAYED_ALERT;
                $alertType = bootstrap::ALERT_TYPE_SUCCESS;
                break;
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusFailed():
                $alert = ClientViewFields::COMPLETION_PAGE_ORDER_FAILED_ALERT;
                $alertType = bootstrap::ALERT_TYPE_DANGER;
                break;
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusCanceled():
                $alert = ClientViewFields::COMPLETION_PAGE_ORDER_CANCELED_ALERT;
                $alertType = bootstrap::ALERT_TYPE_WARNING;
                break;
            case Registry::getRegistry()->getConfigWrapper()->getOrderStatusPending():
            default:
                return $this->elementCompletionPanel;
        }
        return bootstrap::elementAlert(
            Registry::getRegistry()->getConfigWrapper()->cookText(Translator::fromRegistry()->translate($alert), $this->orderWrapper),
            $alertType
        );
    }

    public function elementPageErrorContent() {
        return $this->elementReturnToShopButton()
            . element::br();
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
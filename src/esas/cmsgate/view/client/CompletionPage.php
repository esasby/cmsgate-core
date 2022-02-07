<?php


namespace esas\cmsgate\view\client;


use esas\cmsgate\hutkigrosh\wrappers\ConfigWrapperHutkigrosh;
use esas\cmsgate\lang\Translator;
use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\wrappers\OrderWrapper;

abstract class CompletionPage
{
    /**
     * @var Logger
     */
    protected $logger;
    /**
     * @var ConfigWrapperHutkigrosh
     */
    protected $configWrapper;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @var OrderWrapper
     */
    protected $orderWrapper;

    protected $completionPanel;

    protected $isErrorPage = false;

    /**
     * ViewData constructor.
     * @param OrderWrapper $orderWrapper
     */
    public function __construct($orderWrapper, $completionPanel)
    {
        $this->logger = Logger::getLogger(get_class($this));
        $this->configWrapper = Registry::getRegistry()->getConfigWrapper();
        $this->translator = Registry::getRegistry()->getTranslator();
        $this->orderWrapper = $orderWrapper;
        $this->completionPanel = $completionPanel;
        $this->isErrorPage = Registry::getRegistry()->getMessenger()->hasErrorMessages();
    }

    public function __toString()
    {
        return '<!DOCTYPE html>'
            . element::html(
                $this->elementPageHead(),
                $this->elementPageBody()
            );
    }

    public function render()
    {
        echo $this->__toString();
    }

    public function elementPageHead()
    {
        return element::head(
            element::title(
                element::content($this->getPageTitle())
            ),
            element::meta(
                attribute::charset('utf-8')),
            element::meta(
                attribute::name('viewport'),
                attribute::content('width=device-width, initial-scale=1')),
            element::link(
                attribute::href("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"),
                attribute::rel("stylesheet")),
            element::link(
                attribute::href("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css\""),
                attribute::rel("stylesheet")),
            element::script(
                attribute::src("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js")
            )
        );
    }

    public function getPageTitle()
    {
        return $this->translator->translate(ClientViewFields::COMPLETION_PAGE_TITLE);
    }

    public function elementPageBody()
    {
        return element::body(
            attribute::clazz("d-flex flex-column min-vh-100"),
            $this->elementSectionHeader(),
            $this->elementSectionBody(),
            $this->elementSectionFooter()
        );
    }

    public function elementSectionHeader()
    {
        return element::div(
            attribute::clazz("container-fluid p-5 text-white text-center"),
            attribute::style($this->getElementSectionHeaderStyle()),
            element::content(
                element::h1($this->getElementSectionHeaderTitle()),
                element::p($this->getElementSectionHeaderDetails())
            )
        );
    }

    public function getElementSectionHeaderStyle()
    {
        return "background: #999966";
    }

    public function getElementSectionHeaderTitle()
    {
        return $this->translator->translate(ClientViewFields::COMPLETION_PAGE_HEADER);
    }

    public function getElementSectionHeaderDetails() {
        return $this->isErrorPage ? $this->getElementSectionHeaderOnErrorDetails() :$this->getElementSectionHeaderOnSuccessDetails();
    }


    public function getElementSectionHeaderOnSuccessDetails()
    {
        return $this->translator->translate(ClientViewFields::COMPLETION_PAGE_HEADER_DETAILS);
    }

    public function getElementSectionHeaderOnErrorDetails()
    {
        return "";
    }

    public function elementSectionBody()
    {
        return element::div(
            attribute::clazz('container mt-5'),
            ($this->isErrorPage ? $this->elementErrorMessages() : $this->completionPanel),
            $this->elementReturnToShopButton()
        );
    }

    public function elementErrorMessages()
    {
        $messages = "";
        foreach (Registry::getRegistry()->getMessenger()->getErrorMessagesArray() as $errorText) {
            $messages .= $this->elementErrorMessage($errorText);
        }
        return element::div(
            attribute::clazz("alert alert-danger"),
            attribute::role("alert"),
            element::h4(
                attribute::clazz("alert-heading"),
                $this->translator->translate(ClientViewFields::ERROR)
            ),
            element::p(
                $this->getErrorSorryText()
            ),
            element::hr(),
            element::p(
                Registry::getRegistry()->getMessenger()->getErrorMessages()
            )
        );
    }

    public function elementErrorMessage($errorText)
    {
        return element::p(
            $errorText
        );
    }

    public function getErrorSorryText()
    {
        return $this->translator->translate(ClientViewFields::ERROR_APOLOGIZING);
    }

    public function elementReturnToShopButton()
    {
        return element::div(
            attribute::clazz("row justify-content-center"),
            element::a(
                attribute::href($this->getReturnToShopButtonHref()),
                attribute::clazz($this->getReturnToShopButtonClass()),
                attribute::style($this->getReturnToShopButtonStyle()),
                element::h5(
                    element::i(attribute::clazz("bi bi-arrow-left-short")),
                    $this->getReturnToShopButtonLabel()
                )
            )
        );
    }

    public function getReturnToShopButtonHref()
    {
        return $this->isErrorPage ?
            Registry::getRegistry()->getCmsConnector()->getReturnToShopFailedURL()
            : Registry::getRegistry()->getCmsConnector()->getReturnToShopSuccessURL();
    }

    public function getReturnToShopButtonClass()
    {
        return "btn col-sm-3 mt-3 mb-3 text-center " . ($this->isErrorPage ? "btn-outline-danger" : "text-white");
    }

    public function getReturnToShopButtonStyle()
    {
        return $this->isErrorPage ? "" : "background: #adad85";
    }

    public function getReturnToShopButtonLabel()
    {
        return $this->translator->translate(ClientViewFields::COMPLETION_PAGE_RETURN_TO_SHOP_BUTTON);
    }

    public function elementSectionFooter()
    {
        return
            element::footer(
                attribute::clazz("text-center text-lg-start bg-light text-muted mt-auto"),
                element::div(
                    attribute::clazz("container mt-5"),
                    element::div(
                        attribute::clazz("row"),
                        $this->elementSectionFooterAbout(),
                        $this->elementSectionFooterAddress(),
                        $this->elementSectionFooterContacts()
                    )
                )
            );
    }

    public function elementSectionFooterAbout()
    {
        return $this->elementSectionFooterColumn(
            $this->getElementSectionFooterColumnClass(),
            $this->translator->translate(ClientViewFields::COMPLETION_PAGE_FOOTER_ABOUT),
            $this->getAboutArray()
        );
    }

    public function elementSectionFooterAddress()
    {
        return $this->elementSectionFooterColumn(
            $this->getElementSectionFooterColumnClass(),
            $this->translator->translate(ClientViewFields::COMPLETION_PAGE_FOOTER_ADDRESS),
            $this->getAddressArray()
        );
    }

    public function elementSectionFooterContacts()
    {
        return $this->elementSectionFooterColumn(
            $this->getElementSectionFooterColumnClass(),
            $this->translator->translate(ClientViewFields::COMPLETION_PAGE_FOOTER_CONTACTS),
            $this->getContactsArray()
        );
    }

    public function getElementSectionFooterColumnClass()
    {
        return "col-sm-3";
    }

    public abstract function getAboutArray();

    public abstract function getAddressArray();

    public abstract function getContactsArray();


    public function elementSectionFooterColumn($extraClass, $title, $contentArray)
    {
        $content = '';
        foreach ($contentArray as $contentLine) {
            $content .= element::p(element::small($contentLine));
        }
        return
            element::div(
                attribute::clazz($extraClass . " mx-auto mt-4"),
                element::h6(
                    attribute::clazz("text-uppercase fw-bold mb-4"),
                    element::content($title)
                ),
                element::content($content)
            );
    }
}
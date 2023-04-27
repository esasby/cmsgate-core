<?php


namespace esas\cmsgate\hro\sections;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;
use esas\cmsgate\view\client\ClientViewFields;

class FooterSectionCompanyInfoHRO_v1 implements FooterSectionCompanyInfoHRO
{
    protected $aboutArray;
    protected $addressArray;
    protected $contactArray;

    public static function builder() {
        return new FooterSectionCompanyInfoHRO_v1();
    }

    public function addAboutItem($aboutItem) {
        $this->aboutArray[] = element::p(element::small($aboutItem));
        return $this;
    }

    public function addAddressItem($addressItem) {
        $this->addressArray[] = element::p(element::small($addressItem));
        return $this;
    }

    public function addContactItem($contactItem) {
        $this->contactArray[] = element::p(element::small($contactItem));
        return $this;
    }

    public function addContactItemPhone($contactItemPhone) {
        $this->contactArray[] = element::p(
            bootstrap::elementClickablePhoneExt("text-decoration-none text-muted", $contactItemPhone,
                element::small($contactItemPhone)));
        return $this;
    }

    public function addContactItemEmail($contactItemEmail) {
        $this->contactArray[] = element::p(
            bootstrap::elementClickableEmailExt("text-decoration-none text-muted", $contactItemEmail,
                element::small($contactItemEmail)));
        return $this;
    }

    public function build() {
        return element::footer(
            attribute::clazz("text-center text-lg-start bg-light text-muted mt-auto"),
            attribute::id('element-section-footer'),
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

    public function elementSectionFooterAbout() {
        return $this->elementSectionFooterColumn(
            $this->getElementSectionFooterColumnClass(),
            Translator::fromRegistry()->translate(ClientViewFields::COMPLETION_PAGE_FOOTER_ABOUT),
            $this->aboutArray
        );
    }

    public function elementSectionFooterAddress() {
        return $this->elementSectionFooterColumn(
            $this->getElementSectionFooterColumnClass(),
            Translator::fromRegistry()->translate(ClientViewFields::COMPLETION_PAGE_FOOTER_ADDRESS),
            $this->addressArray
        );
    }

    public function elementSectionFooterContacts() {
        return $this->elementSectionFooterColumn(
            $this->getElementSectionFooterColumnClass(),
            Translator::fromRegistry()->translate(ClientViewFields::COMPLETION_PAGE_FOOTER_CONTACTS),
            $this->contactArray
        );
    }

    public function getElementSectionFooterColumnClass() {
        return "col-sm-3";
    }

    public function elementSectionFooterColumn($extraClass, $title, $contentArray) {
        $content = '';
        foreach ($contentArray as $contentLine) {
            $content .= $contentLine;
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
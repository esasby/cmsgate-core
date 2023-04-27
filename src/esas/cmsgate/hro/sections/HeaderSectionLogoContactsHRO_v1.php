<?php


namespace esas\cmsgate\hro\sections;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;
use esas\cmsgate\view\client\ClientViewFields;

class HeaderSectionLogoContactsHRO_v1 implements HeaderSectionLogoContactsHRO
{
    protected $logoUrl;
    protected $smallLogoUrl;
    protected $title;
    protected $titleDetails;
    protected $elementContacts;

    public static function builder() {
        return new HeaderSectionLogoContactsHRO_v1();
    }

    public function build() {
        $builder = HeaderSection3ColHROFactory::findBuilder();
        $builder
            ->setElementStartColumn(
                    element::img(
                        attribute::clazz("d-none d-md-block"),
                        attribute::src($this->logoUrl),
                        attribute::width('200')) .
                    element::img(
                        attribute::clazz("d-sm-block d-md-none"),
                        attribute::src($this->smallLogoUrl)
//                        attribute::width('200')
                    ))
            ->setElementCenterColumn(
                element::h1($this->title) .
                element::p($this->titleDetails))
            ->setElementEndColumn(
                element::h6(
                    attribute::clazz("text-uppercase fw-bold mt-2"),
                    element::content(Translator::fromRegistry()->translate(ClientViewFields::CONTACTS))) .
                $this->elementContacts
            );
        return $builder->build();
    }

    /**
     * @inheritDoc
     */
    public function setLogo($logoUrl) {
        $this->logoUrl = $logoUrl;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setSmallLogo($smallLogoUrl) {
        $this->smallLogoUrl = $smallLogoUrl;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setTitleDetails($titleDetails) {
        $this->titleDetails = $titleDetails;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addContactItem($contactItem) {
        $this->elementContacts .=
            element::p(
                attribute::clazz("mb-0"),
                element::small($contactItem));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addContactItemPhone($contactItemPhone) {
        $this->elementContacts .=
            element::p(
                attribute::clazz("mb-0"),
                bootstrap::elementClickablePhoneExt("text-decoration-none", $contactItemPhone,
                    element::small($contactItemPhone)));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addContactItemEmail($contactItemEmail) {
        $this->elementContacts .=
            element::p(
                attribute::clazz("mb-0"),
                bootstrap::elementClickableEmailExt("text-decoration-none", $contactItemEmail,
                    element::small($contactItemEmail)));
        return $this;
    }
}
<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\hro\cards\CardFooterHRO;
use esas\cmsgate\hro\cards\CardFooterHROFactory;
use esas\cmsgate\hro\cards\CardFormHRO;
use esas\cmsgate\hro\cards\CardHeaderHRO;
use esas\cmsgate\hro\cards\CardHeaderHROFactory;
use esas\cmsgate\hro\cards\CardHROFactory;
use esas\cmsgate\view\admin\AdminViewFields;

class FormHRO_v2 extends FormHRO_v1 implements CardFormHRO
{
    /**
     * @var CardFooterHRO
     */
    protected $cardFooter;

    /**
     * @var CardHeaderHRO
     */
    protected $cardHeader;

    public static function builder() {
        return new FormHRO_v2();
    }

    public function __construct() {
        $this->cardHeader = CardHeaderHROFactory::findBuilder();
        $this->cardFooter = CardFooterHROFactory::findBuilder();
    }

    public function addFooterButton($label, $href, $classAppend = '') {
        $this->cardFooter->addButton($label, $href, $classAppend);
        return $this;
    }

    public function addButtonCancel($redirectHref) {
        $this->cardFooter->addButtonCancel($redirectHref);
        return $this;
    }

    public function addButtonSave() {
        $this->cardFooter->addButtonSubmit(AdminViewFields::CONFIG_FORM_BUTTON_SAVE);
        return $this;
    }

    public function addButtonDelete($redirectHref) {
        $this->cardFooter->addButtonDelete($redirectHref);
        return $this;
    }

    public function addHeaderButton($label, $href, $classAppend = '') {
        $this->cardHeader->addButton($label, $href, $classAppend);
        return $this;
    }

    public function setId($id) {
        parent::setId($id);
        $this->cardHeader->setLabel(Translator::fromRegistry()->translate($id));
        return $this;
    }

    public function elementFormBody() {
        return CardHROFactory::findBuilder()
            ->setCardHeader(
                $this->cardHeader->build())
            ->setCardBody($this->elementFormFields() . $this->hiddenInput)
            ->setCardFooter(
                $this->cardFooter->build())
            ->build();
    }


}
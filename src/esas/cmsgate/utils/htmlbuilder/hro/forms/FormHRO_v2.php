<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\forms;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardFooterHRO;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardFormHRO;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardHeaderHRO;
use esas\cmsgate\utils\htmlbuilder\hro\HROFactoryCmsGate;
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
        $this->cardHeader = HROFactoryCmsGate::fromRegistry()->createCardHeaderBuilder();
        $this->cardFooter = HROFactoryCmsGate::fromRegistry()->createCardFooterBuilder();
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
        return HROFactoryCmsGate::fromRegistry()->createCardBuilder()
            ->setCardHeader(
                $this->cardHeader->build())
            ->setCardBody($this->elementFormFields() . $this->hiddenInput)
            ->setCardFooter(
                $this->cardFooter->build())
            ->build();
    }


}
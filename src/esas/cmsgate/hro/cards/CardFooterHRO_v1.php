<?php


namespace esas\cmsgate\hro\cards;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;
use esas\cmsgate\view\admin\AdminViewFields;

class CardFooterHRO_v1 implements CardFooterHRO
{

    public static function builder() {
        return new CardFooterHRO_v1();
    }

    protected $elementCardButtons;
    protected $elementCardButtonsSubmit;
    protected $elementCardButtonCancel; // it must be always on the right

    public function addButton($label, $href, $classAppend, $translateLabel = true) {
        $this->elementCardButtons .= bootstrap::elementAButton($translateLabel ? Translator::fromRegistry()->translate($label) : $label, $href, $classAppend);
        return $this;
    }

    public function addButtonCancel($redirectHref) {
        $this->elementCardButtonCancel = bootstrap::elementAButton(Translator::fromRegistry()->translate(AdminViewFields::CANCEL), $redirectHref, 'btn-secondary');
        return $this;
    }

    public function addButtonDelete($redirectHref) {
        $this->addButton(AdminViewFields::DELETE, $redirectHref, 'btn-secondary', true);
        return $this;
    }

    public function build() {
        return
            element::div(
                attribute::clazz("row"),
                element::div(
                    attribute::clazz("col col-sm-12 d-flex justify-content-end"),
                    $this->elementCardButtons,
                    $this->elementCardButtonsSubmit,
                    $this->elementCardButtonCancel
                )
            );
    }

    public function addButtonSubmit($name, $value = null) {
        if ($value == null)
            $value = Registry::getRegistry()->getTranslator()->translate($name);
        $this->elementCardButtonsSubmit .= element::input(
            attribute::clazz("btn btn-secondary me-1"),
            attribute::type("submit"),
            attribute::name($name),
            attribute::value($value)
        );
        return $this;
    }
}
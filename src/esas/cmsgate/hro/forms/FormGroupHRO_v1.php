<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;
use esas\cmsgate\view\admin\fields\ConfigField;

class FormGroupHRO_v1 implements FormGroupHRO
{
    protected $field;
    protected $input;
    protected $extraElements;
    protected $oneRow = true;

    public function setField(ConfigField $configField) {
        $this->field = $configField;
        return $this;
    }

    public function setInput($input) {
        $this->input = $input;
        return $this;
    }

    /**
     * @param mixed $extraElements
     * @return FormGroupHRO_v1
     */
    public function addExtraElements($extraElements) {
        $this->extraElements = $extraElements;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setOneRow($oneRow) {
        $this->oneRow = $oneRow;
        return $this;
    }

    public static function builder() {
        return new FormGroupHRO_v1();
    }

    public function build() {
        return
            element::div(
                attribute::clazz((bootstrap::isBootstrapV4() ? "form-group" : "mb-3") . ($this->oneRow ? " row" : "")),
                self::elementLabel($this->field),
                element::div(
                    attribute::clazz("col"),
                    $this->input,
                    self::elementInputValidationDetails($this->field)
                ),
                $this->extraElements);
    }

    public function elementLabel(ConfigField $configField) {
        return
            element::label(
                attribute::forr($configField->getKey()),
                attribute::clazz("col-form-label" . ($this->oneRow ? " col-2" : "")),
                attribute::data_toggle("tooltip"),
                attribute::data_placement("left"),
                attribute::title($configField->getDescription()),
                element::content($configField->getName()),
                $configField->isRequired() ? element::span(attribute::style("color:red"), "*") : "",
                element::span(
                    attribute::data_toggle("tooltip"),
                    attribute::title($configField->getDescription())

                )
            );
    }

    public function elementInputValidationDetails(ConfigField $configField) {
        $validationResult = $configField->getValidationResult();
        if ($validationResult == null || $validationResult->isValid())
            return '';
        else
            return element::small(
                attribute::clazz('text-danger'),
                $validationResult->getErrorTextSimple()
            );
    }
}
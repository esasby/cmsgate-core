<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\view\admin\fields\ConfigField;

class FormFieldTextHRO_v1 implements FormFieldTextHRO
{
    /**
     * @var ConfigField
     */
    protected $fieldDescriptor;
    protected $onFieldAction;
    protected $oneRow = true;

    /**
     * @inheritDoc
     */
    public function setFieldDescriptor(ConfigField $field) {
        $this->fieldDescriptor = $field;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addOnFieldAction($onFieldAction) {
        $this->onFieldAction .= $onFieldAction;
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
        return new FormFieldTextHRO_v1();
    }

    public function build() {
        $formGroupBuilder = FormGroupHROFactory::findBuilder()
            ->setField($this->fieldDescriptor)
            ->setInput(FormHRO_v1::elementInput($this->fieldDescriptor, "text"))
            ->setOneRow($this->oneRow);
        if ($this->onFieldAction != null)
            $formGroupBuilder->addExtraElements(element::div(
                attribute::clazz('btn-group col col-auto pl-0'),
                $this->onFieldAction));
        return $formGroupBuilder->build();
    }


}
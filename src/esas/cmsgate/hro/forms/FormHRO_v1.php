<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\Registry;
use esas\cmsgate\utils\CMSGateException;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;
use esas\cmsgate\utils\UploadedFileWrapper;
use esas\cmsgate\view\admin\AdminViewFields;
use esas\cmsgate\view\admin\fields\ConfigField;
use esas\cmsgate\view\admin\fields\ConfigFieldCheckbox;
use esas\cmsgate\view\admin\fields\ConfigFieldDateTime;
use esas\cmsgate\view\admin\fields\ConfigFieldFile;
use esas\cmsgate\view\admin\fields\ConfigFieldList;
use esas\cmsgate\view\admin\fields\ConfigFieldNumber;
use esas\cmsgate\view\admin\fields\ConfigFieldPassword;
use esas\cmsgate\view\admin\fields\ConfigFieldRichtext;
use esas\cmsgate\view\admin\fields\ConfigFieldTextarea;
use esas\cmsgate\view\admin\ManagedFields;

/**
 * @package esas\cmsgate\hro\forms
 */
class FormHRO_v1 implements FormHRO
{
    protected $id;
    protected $action;
    /**
     * @var ManagedFields
     */
    protected $managedFields;
    protected $hiddenInput;

    protected $elementButtonsSubmit;
    protected $elementButtons;
    protected $elementButtonsCancel;

    /**
     * @param mixed $id
     * @return FormHRO_v1
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }


    /**
     * @param string $action
     * @return FormHRO_v1
     */
    public function setAction($action) {
        $this->action = $action;
        return $this;
    }

    /**
     * @param ManagedFields $managedFields
     * @return FormHRO_v1
     */
    public function setManagedFields($managedFields) {
        $this->managedFields = $managedFields;
        return $this;
    }

    /**
     * @param $field ConfigField
     */
    public function addManagedField($field) {
        if ($this->managedFields == null)
            $this->managedFields = new ManagedFields();
        $this->managedFields->addField($field);
        return $this;
    }

    public function addHiddenInput($key, $value) {
        $this->hiddenInput .= element::input(
            attribute::name($key),
            attribute::type('hidden'),
            attribute::id($key),
            attribute::value($value)
        );
        return $this;
    }

    public static function builder() {
        return new FormHRO_v1();
    }

    public function build() {
        return
            element::form(
                ($this->action != null ? attribute::action($this->action) : ""),
                attribute::method("post"),
                attribute::enctype("multipart/form-data"),
                ($this->id != null ? attribute::id($this->id) : ""),
                $this->elementFormBody()
            );
    }

    public function elementFormBody() {
        return $this->elementFormFields()
            . $this->hiddenInput
            . $this->elementButtons
            . $this->elementButtonsSubmit
            . $this->elementButtonsCancel;
    }

    public function elementFormFields() {
        $ret = "";
        // при проверке instanceof не забывать про наследование
        foreach ($this->managedFields->getFieldsToRender() as $configField) {
            if ($configField instanceof ConfigFieldPassword) {
                $ret .= $this->elementFormFieldPassword($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldRichtext) {
                $ret .= $this->elementFormFieldRichtext($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldTextarea) {
                $ret .= $this->elementFormFieldTextArea($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldNumber) {
                $ret .= $this->elementFormFieldNumber($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldCheckbox) {
                $ret .= $this->elementFormFieldCheckbox($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldList) {
                $ret .= $this->elementFormFieldListField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldFile) {
                $ret .= $this->elementFormFieldFile($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldDateTime) {
                $ret .= $this->elementFormFieldDateTime($configField);
                continue;
            } else
                $ret .= $this->elementFormFieldText($configField);
        }
        return $ret;
    }

    public static function elementFormGroup(ConfigField $configField, $input, ...$extraElements) {
        return bootstrap::formGroup(
            self::elementLabel($configField),
            element::div(
                attribute::clazz("col"),
                $input,
                self::elementInputValidationDetails($configField)
            ),
            $extraElements
        );
    }

    public static function elementInputValidationDetails(ConfigField $configField) {
        $validationResult = $configField->getValidationResult();
        if ($validationResult == null || $validationResult->isValid())
            return '';
        else
            return element::small(
                attribute::clazz('text-danger'),
                $validationResult->getErrorTextSimple()
            );
    }

    public function elementFormFieldText(ConfigField $configField) {
        return
            self::elementFormGroup(
                $configField,
                self::elementInput($configField, "text")
            );
    }

    public function elementFormFieldDateTime(ConfigField $configField) {
        return
            self::elementFormGroup(
                $configField,
                self::elementInput($configField, "datetime-local")
            );
    }

    public function elementFormFieldPassword(ConfigFieldPassword $configField) {
        return
            self::elementFormGroup(
                $configField,
                self::elementInput($configField, "password")
            );
    }

    public function elementFormFieldTextArea(ConfigFieldTextarea $configField) {
        return
            self::elementFormGroup(
                $configField,
                element::textarea(
                    $configField->getCols() != null ? attribute::cols($configField->getCols()) : "",
                    attribute::rows($configField->getRows()),
                    attribute::clazz("form-control "),
                    attribute::type("textarea"),
                    attribute::name($configField->getKey()),
                    attribute::id($configField->getKey()),
                    element::content($configField->getValue())
                )
            );
    }


    public function elementFormFieldFile(ConfigFieldFile $configField) {
        throw new CMSGateException("Not implemented");
    }

    private function getFileColor($fileName) {
        $file = new UploadedFileWrapper($fileName);
        return $file->isExists() ? "green" : "red";
    }

    public function elementFormFieldCheckbox(ConfigFieldCheckbox $configField) {
        return
            self::elementFormGroup(
                $configField,
                element::input(
                    bootstrap::isBootstrapV5() ? attribute::clazz('form-check-input') : "",
                    attribute::type("checkbox"),
                    attribute::name($configField->getKey()),
                    attribute::value("yes"),
                    attribute::checked($configField->isChecked())
                )
            );
    }

    public function elementFormFieldListField(ConfigFieldList $configField) {
        return
            self::elementFormGroup(
                $configField,
                element::select(
                    attribute::clazz("form-control"),
                    attribute::name($configField->getKey()),
                    attribute::id($configField->getKey()),
                    $this->elementFormFieldListOptions($configField)
                )
            );
    }


    public static function elementLabel(ConfigField $configField) {
        return
            element::label(
                attribute::forr($configField->getKey()),
                attribute::clazz("col-sm-2 col-form-label"),
                attribute::data_toggle("tooltip"),
                attribute::data_placement("left"),
                attribute::title($configField->getDescription()),
                element::content($configField->getName()),
                element::span(
                    attribute::data_toggle("tooltip"),
                    attribute::title($configField->getDescription())

                )
            );
    }

    public static function elementInput(ConfigField $configField, $type) {
        return
            element::input(
                attribute::clazz("form-control " . ($configField->isValid() ? "" : "border-danger")),
                attribute::name($configField->getKey()),
                attribute::type($type),
                attribute::readOnly($configField->isReadOnly()),
                attribute::id($configField->getKey()),
                attribute::placeholder($configField->getName()),
                attribute::value($configField->getValue())
            );
    }

    public static function elementValidationError(ConfigField $configField) {
        $validationResult = $configField->getValidationResult();
        if ($validationResult != null && !$validationResult->isValid())
            return
                element::p(
                    element::font(
                        attribute::color("red"),
                        element::content($validationResult->getErrorTextSimple())
                    )
                );
        else
            return "";
    }

    public function elementFormFieldRichtext(ConfigFieldRichtext $configField) {
        return $this->elementFormFieldTextArea($configField);
    }

    public function elementFormFieldNumber(ConfigFieldNumber $configField) {
        return $this->elementFormFieldText($configField);
    }

    public function elementFormFieldListOptions(ConfigFieldList $configField) {
        $ret = array();
        foreach ($configField->getOptions() as $option) {
            $ret[] = element::option(
                attribute::value($option->getValue()),
                attribute::selected($option->getValue() == $configField->getValue()),
                element::content($option->getName())
            );
        }
        return $ret;
    }

    public function addButtonSubmit($name, $value = null) {
        if ($value == null)
            $value = Registry::getRegistry()->getTranslator()->translate($name);
        $this->elementButtonsSubmit .= element::input(
            attribute::clazz("btn btn-secondary me-1"),
            attribute::type("submit"),
            attribute::name($name),
            attribute::value($value)
        );
        return $this;
    }

    public function addButtonSave() {
        return $this->addButtonSubmit(AdminViewFields::CONFIG_FORM_BUTTON_SAVE);
    }

    public function addButtonDelete($redirectHref) {
        return $this->addButton(AdminViewFields::DELETE, $redirectHref);
    }

    public function addButtonCancel($redirectHref) {
        $this->elementButtonsCancel .= element::a(
            attribute::href($redirectHref),
            attribute::clazz('btn me-1'),
            element::content(Translator::fromRegistry()->translate(AdminViewFields::CANCEL))
        );
        return $this;
    }

    public function addButton($label, $href, $classAppend = '') {
        $this->elementButtons .= element::a(
            attribute::href($href),
            attribute::clazz('btn me-1 ' . $classAppend),
            element::content($label)
        );
        return $this;
    }
}
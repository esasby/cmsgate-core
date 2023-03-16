<?php


namespace esas\cmsgate\utils\htmlbuilder;


use esas\cmsgate\messenger\Messages;
use esas\cmsgate\Registry;
use esas\cmsgate\utils\CMSGateException;
use esas\cmsgate\view\admin\ConfigForm;
use esas\cmsgate\view\admin\fields\ConfigFieldCheckbox;
use esas\cmsgate\view\admin\fields\ConfigFieldFile;
use esas\cmsgate\view\admin\ManagedFields;
use Exception;

class FormUtils
{
    /**
     * @param $managedFields ManagedFields
     * @param $exceptFields array fields to skip
     * @return array
     * @throws CMSGateException
     */
    public static function extractInputsFromRequest($managedFields, $exceptFields = null) {
        $values = $_REQUEST;
        $configs = array();
        foreach ($managedFields->getFieldsToRender() as $configField) {
            if ($exceptFields != null && in_array($configField->getKey(), $exceptFields))
                continue; //skipping field
            if ($configField instanceof ConfigFieldFile) {
                throw new CMSGateException("Please, implement me!");
            } else if ($configField instanceof ConfigFieldCheckbox) {
                $value = array_key_exists($configField->getKey(), $values) ? $values[$configField->getKey()] : "";
                $configs[$configField->getKey()] = $value;
            } else {
                $value = array_key_exists($configField->getKey(), $values) ? $values[$configField->getKey()] : $configField->getValue();
                $configs[$configField->getKey()] = $value;
            }
        }
        return $configs;
    }

    /**
     * @param $form ConfigForm
     * @param array $fieldValues
     * @param array $filesMeta
     * @throws Exception
     */
    public static function validateInputs($form, $fieldValues = null, $filesMeta = null) {
        $fieldsAreValid = $form->getManagedFields()->validateAll($fieldValues != null ? $fieldValues : $_REQUEST);
        $filesAreValid = $form->getManagedFields()->validateAll($filesMeta != null ? $filesMeta : $_FILES);
        if (!$fieldsAreValid || !$filesAreValid) {
            Registry::getRegistry()->getMessenger()->addErrorMessage(Messages::INCORRECT_INPUT);
            throw new Exception('Form is not valid');
        }
    }
}
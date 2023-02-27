<?php


namespace esas\cmsgate\utils\htmlbuilder;


use esas\cmsgate\messenger\Messages;
use esas\cmsgate\Registry;
use esas\cmsgate\utils\CMSGateException;
use esas\cmsgate\view\admin\ConfigForm;
use esas\cmsgate\view\admin\fields\ConfigFieldCheckbox;
use esas\cmsgate\view\admin\fields\ConfigFieldFile;
use Exception;

class FormUtils
{
    /**
     * @param $form ConfigForm
     * @param $exceptFields array fields to skip
     * @return array
     * @throws CMSGateException
     */
    public static function extractInputsFromRequest($form, $exceptFields = null)
    {
        if (array_key_exists($form->getFormKey(), $_REQUEST)) // иногда настройки могут приходить сгруппированными по имени формы
            $values = $_REQUEST[$form->getFormKey()];
        else
            $values = $_REQUEST;
        $configs = array();
        foreach ($form->getManagedFields()->getFieldsToRender() as $configField) {
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
    public static function validateInputs($form, $fieldValues = null, $filesMeta = null)
    {
        $fieldsAreValid = $form->getManagedFields()->validateAll($fieldValues != null ? $fieldValues : $_REQUEST);
        $filesAreValid = $form->getManagedFields()->validateAll($filesMeta != null ? $filesMeta : $_FILES);
        if (!$fieldsAreValid || !$filesAreValid) {
            Registry::getRegistry()->getMessenger()->addErrorMessage(Messages::INCORRECT_INPUT);
            throw new Exception('Form is not valid');
        }
    }
}
<?php


namespace esas\cmsgate\utils\htmlbuilder\page;


use esas\cmsgate\messenger\Messages;
use esas\cmsgate\Registry;
use esas\cmsgate\utils\FileUtils;
use esas\cmsgate\view\admin\fields\ConfigFieldCheckbox;
use esas\cmsgate\view\admin\fields\ConfigFieldFile;
use Exception;

class PageUtils
{
    /**
     * @param $page SingleFormPage
     */
    public static function validateFormInputAndRenderOnError($page) {
        try {
            $managedFields = $page->getFormFields();
            $fieldsAreValid = $managedFields->validateAll($_REQUEST);
            $filesAreValid = $managedFields->validateAll($_FILES);
            if (!$fieldsAreValid || !$filesAreValid) {
                Registry::getRegistry()->getMessenger()->addErrorMessage(Messages::INCORRECT_INPUT);
                throw new Exception('Form is not valid');
            }
        } catch (Exception $e) {
            $page->render();
            exit(0);
        }
    }

    /**
     * @param $page StorableFormPage
     * @throws \Throwable
     */
    public static function storeFormData($page) {
//        if (array_key_exists($this->formKey, $_REQUEST)) // иногда настройки могут приходить сгруппированными по имени формы
//            $values = $_REQUEST[$this->formKey];
//        else
        $values = $_REQUEST;

        $configs = array();
        foreach ($page->getFormFields()->getFieldsToRender() as $configField) {
            if ($configField instanceof ConfigFieldFile) {
                $fileMeta = $_FILES[$configField->getKey()];
                if ($fileMeta != null) {
                    FileUtils::uploadFile($configField->getKey());
                }
            } else if ($configField instanceof ConfigFieldCheckbox) {
                $value = array_key_exists($configField->getKey(), $values) ? $values[$configField->getKey()] : "";
                $configs[$configField->getKey()] = $value;
//                Registry::getRegistry()->getConfigWrapper()->saveConfig($configField->getKey(), $value);
            } else {
                $value = array_key_exists($configField->getKey(), $values) ? $values[$configField->getKey()] : $configField->getValue();
                $configs[$configField->getKey()] = $value;
//                Registry::getRegistry()->getConfigWrapper()->saveConfig($configField->getKey(), $value);
            }
        }
        $page->getStorage()->saveConfigs($configs);
        Registry::getRegistry()->getMessenger()->addInfoMessage(Messages::SETTINGS_SAVED);
    }
}
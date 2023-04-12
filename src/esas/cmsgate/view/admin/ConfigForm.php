<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 30.09.2018
 * Time: 15:15
 */

namespace esas\cmsgate\view\admin;


use esas\cmsgate\messenger\Messages;
use esas\cmsgate\Registry;
use esas\cmsgate\utils\FileUtils;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\view\admin\fields\ConfigField;
use esas\cmsgate\view\admin\fields\ConfigFieldCheckbox;
use esas\cmsgate\view\admin\fields\ConfigFieldFile;
use esas\cmsgate\view\admin\fields\ConfigFieldList;
use esas\cmsgate\view\admin\fields\ConfigFieldNumber;
use esas\cmsgate\view\admin\fields\ConfigFieldPassword;
use esas\cmsgate\view\admin\fields\ConfigFieldRichtext;
use esas\cmsgate\view\admin\fields\ConfigFieldStatusList;
use esas\cmsgate\view\admin\fields\ConfigFieldTextarea;
use esas\cmsgate\view\admin\fields\ListOption;
use Exception;

/**
 * Class ConfigForm обеспечивает генерация формы с настройками плагина (может быть как генерация конечного html,
 * так и каких-то промежуточных структур, в зависимости от CMS)
 * В плагинах для конкретных CMS должен быть создан наследник и переопределены методы generate****Field
 * (минимум должен быть переопределен generateTextField).
 * Пример использования для opencart:
 * $configForm = new ConfigFormOpencart();
 * $configForm->addAll();
 * $configForm->addField(new ConfigFieldNumber <> ); // добавление какого-то особоного поля для CMS
 * $configForm->generate(); // формирует форму
 * @package esas\cmsgate\view\admin
 */
abstract class ConfigForm
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var ManagedFields
     */
    protected $managedFields;

    /**
     * @var string
     */
    protected $formKey;

    /**
     * ConfigurationRender constructor.
     * @param $formKey
     * @param ManagedFields $managedFields
     */
    public function __construct($formKey, $managedFields)
    {
        $this->logger = Logger::getLogger(get_class($this));
        $this->managedFields = $managedFields;
        $this->formKey = $formKey;
    }

    /**
     * @return ManagedFields
     */
    public function getManagedFields()
    {
        return $this->managedFields;
    }

    /**
     * @return string
     */
    public function getFormKey()
    {
        return $this->formKey;
    }

    /**
     * @param string $formKey
     * @return ConfigForm
     */
    public function setFormKey($formKey) {
        $this->formKey = $formKey;
        return $this;
    }


    /**
     * Производит формирование формы с настройками модуля
     * @return mixed
     */
    public abstract function generate();

    /**
     * Формирование html разметки для текстового поля. Он используется по умолчанию и для всех остальных типов полей
     * (если не переопределены соответствующие методы)
     * @param ConfigField $configField
     * @return mixed
     */
    abstract function generateTextField(ConfigField $configField);

    public function generateTextAreaField(ConfigFieldTextarea $configField)
    {
        return $this->generateTextField($configField);
    }

    public function generateRichtextField(ConfigFieldRichtext $configField)
    {
        return $this->generateTextAreaField($configField);
    }

    public function generateNumberField(ConfigFieldNumber $configField)
    {
        return $this->generateTextField($configField);
    }

    public function generatePasswordField(ConfigFieldPassword $configField)
    {
        return $this->generateTextField($configField);
    }

    public function generateCheckboxField(ConfigFieldCheckbox $configField)
    {
        return $this->generateTextField($configField);
    }

    public function generateFileField(ConfigFieldFile $configField)
    {
        return $this->generateTextField($configField);
    }

    public function generateStatusListField(ConfigFieldStatusList $configField)
    {
        $configField->setOptions($this->createStatusListOptions());
        return $this->generateListField($configField);
    }

    public function generateListField(ConfigFieldList $configField)
    {
        return $this->generateTextField($configField);
    }

    /**
     * @return ListOption[]
     */
    public abstract function createStatusListOptions();

    /**
     * @throws Exception
     */
    public function validate($fieldValues = null, $filesMeta = null)
    {
        $fieldsAreValid = $this->getManagedFields()->validateAll($fieldValues != null ? $fieldValues : $_REQUEST);
        $filesAreValid = $this->getManagedFields()->validateAll($filesMeta != null ? $filesMeta : $_FILES);
        if (!$fieldsAreValid || !$filesAreValid) {
            Registry::getRegistry()->getMessenger()->addErrorMessage(Messages::INCORRECT_INPUT);
            throw new Exception('Config form is not valid');
        }
    }


    /**
     * @param null $fieldValues
     * @param null $filesMeta
     * @return bool
     */
    public function isValid($fieldValues = null, $filesMeta = null)
    {
        if ($fieldValues == null && $filesMeta == null)
            return $this->getManagedFields()->isValid();
        try {
            $this->validate($fieldValues, $filesMeta);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * @throws \Throwable
     */
    public function save()
    {
        if (array_key_exists($this->formKey, $_REQUEST)) // иногда настройки могут приходить сгруппированными по имени формы
            $values = $_REQUEST[$this->formKey];
        else
            $values = $_REQUEST;
        $configs = array();
        foreach ($this->getManagedFields()->getFieldsToRender() as $configField) {
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
        Registry::getRegistry()->getConfigWrapper()->saveConfigs($configs);
        Registry::getRegistry()->getMessenger()->addInfoMessage(Messages::SETTINGS_SAVED);
    }
}




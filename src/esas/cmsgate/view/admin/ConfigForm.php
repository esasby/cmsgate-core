<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 30.09.2018
 * Time: 15:15
 */

namespace esas\cmsgate\view\admin;


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
use esas\cmsgate\messenger\Messages;
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
     * ConfigurationRender constructor.
     * @param ManagedFields $managedFields
     */
    public function __construct($managedFields)
    {
        $this->logger = Logger::getLogger(get_class($this));
        $this->managedFields = $managedFields;
    }

    /**
     * @return ManagedFields
     */
    public function getManagedFields()
    {
        return $this->managedFields;
    }

    /**
     * Производит формирование формы с настройками модуля
     * @return string
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
     * @throws \Throwable
     */
    public function save()
    {
        foreach ($this->getManagedFields()->getFieldsToRender() as $configField) {
            $value = array_key_exists($configField->getKey(), $_REQUEST) ? $_REQUEST[$configField->getKey()] : "";
            if ($configField instanceof ConfigFieldFile) {
                $fileMeta = $_FILES[$configField->getKey()];
                if ($fileMeta != null) {
                    FileUtils::uploadFile($configField->getKey());
                }
            } else
                Registry::getRegistry()->getConfigWrapper()->saveConfig($configField->getKey(), $value);
        }
        Registry::getRegistry()->getMessenger()->addInfoMessage(Messages::SETTINGS_SAVED);
    }
}




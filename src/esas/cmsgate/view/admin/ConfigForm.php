<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 30.09.2018
 * Time: 15:15
 */

namespace esas\cmsgate\view\admin;


use esas\cmsgate\utils\Logger;
use esas\cmsgate\view\admin\fields\ConfigField;
use esas\cmsgate\view\admin\fields\ConfigFieldCheckbox;
use esas\cmsgate\view\admin\fields\ConfigFieldList;
use esas\cmsgate\view\admin\fields\ConfigFieldNumber;
use esas\cmsgate\view\admin\fields\ConfigFieldPassword;
use esas\cmsgate\view\admin\fields\ConfigFieldRichtext;
use esas\cmsgate\view\admin\fields\ConfigFieldStatusList;
use esas\cmsgate\view\admin\fields\ConfigFieldTextarea;
use esas\cmsgate\view\admin\fields\ListOption;
use esas\cmsgate\view\admin\validators\ValidationResult;

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
     * Массив настроек, которые должны быть отображены для конкретного модуля
     * @var ConfigField[]
     */
    protected $fieldsToRender;

    /**
     * Массив для хранения всех возможнах настроек модуля
     * @var ConfigField[]
     */
    protected $allFields;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Общий итоговый текст, содержащий все ошибки валидации
     * @var string
     */
    protected $validationErrorText;

    protected $sortOrderCounter = 0;

    /**
     * ConfigurationRender constructor.
     */
    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));
        foreach ($this->initFields() as $configField) {
        $configField->setSortOrder(++$this->sortOrderCounter);
        $this->allFields[$configField->getKey()] = $configField;
    }
    }

    /**
     * Метод для инициализации полей
     * @return ConfigField[]
     */
    public abstract function initFields();


    /**
     * Добавление всех полей
     */
    public function addAll()
    {
        unset($this->fieldsToRender);
        $this->fieldsToRender = $this->allFields;
    }

    /**
     * Добавление всех полей, исключая перечисленные
     */
    public function addAllExcept(array $exclude)
    {
        unset($this->fieldsToRender);
        foreach ($this->allFields as $configField) {
            if (!in_array($configField->getKey(), $exclude)) {
                $this->addField($configField);
            }
        }
    }

    /**
     * Добавление одного поля. Может использоваться в CMS для добавления спец. полей
     */
    public function addField(ConfigField $configField)
    {
        $this->fieldsToRender[$configField->getKey()] = $configField;
    }

    /**
     * Получение поля по ключу
     */
    public function getField($key)
    {
        if (array_key_exists($key, $this->fieldsToRender))
            return $this->fieldsToRender[$key];
        else
            return null;
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
     * Проверка корректности введенного значения. По кллючу поля $configKey получает соответсвующий ему валидатор
     * и вызывае его для значения $configValue
     * @param $configKey - ключ поля
     * @param $configValue - проверяемое значение
     * @return ValidationResult
     */
    public function validate($configKey, $configValue)
    {
        $configField = $this->getField($configKey);
        $validationResult = $configField->validate($configValue);
        if (!$validationResult->isValid()) {
            $this->logger->error("Configuration field[" . $configKey . "] value[" . $configValue . "] is not valid: " . $validationResult->getErrorTextSimple());
            $this->validationErrorText .= $validationResult->getErrorTextFull() . "\n";
        }
        return $validationResult;
    }

    /**
     * Групповая валидация полей, переданных ввиде массива ключ-значение
     * @param $keyValueArray
     * @return bool
     */
    public function validateAll($keyValueArray)
    {
        $ret = true;
        $this->validationErrorText = "";
        foreach ($keyValueArray as $key => $value) {
            if (!$this->validate($key, $value)->isValid()) {
                $ret = false;
            }
        }
        return $ret;
    }

    /**
     * @return mixed
     */
    public function getValidationErrorText()
    {
        return $this->validationErrorText;
    }
}




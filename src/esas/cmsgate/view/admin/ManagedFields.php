<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 12.07.2019
 * Time: 11:46
 */

namespace esas\cmsgate\view\admin;


use esas\cmsgate\utils\Logger;
use esas\cmsgate\view\admin\fields\ConfigField;
use esas\cmsgate\view\admin\validators\ValidationResult;

abstract class ManagedFields
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
     * ManagedFields constructor.
     */
    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));
    }

    /**
     * Внутренний метод для заполнения массива всез настроек
     * @param ConfigField $configField
     */
    protected function registerField(ConfigField $configField)
    {
        $configField->setSortOrder(++$this->sortOrderCounter);
        $this->allFields[$configField->getKey()] = $configField;
    }


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
     * @return ConfigField[]
     */
    public function getFieldsToRender() {
        return $this->fieldsToRender;
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
     * Проверка корректности введенного значения. По кллючу поля $configKey получает соответсвующий ему валидатор
     * и вызывае его для значения $configValue
     * @param $configKey - ключ поля
     * @param $configValue - проверяемое значение
     * @return ValidationResult
     */
    public function validate($configKey, $configValue)
    {
        $configField = $this->getField($configKey);
        if ($configField == null)
            return new ValidationResult(); //неизвестные поля пропускаем
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
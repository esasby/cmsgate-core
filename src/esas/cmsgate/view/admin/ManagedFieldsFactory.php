<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 05.05.2020
 * Time: 15:16
 */

namespace esas\cmsgate\view\admin;


use esas\cmsgate\utils\Logger;
use esas\cmsgate\view\admin\fields\ConfigField;
use Exception;

/**
 * Class ManagedFieldsFactory используется для создания и доступа к ConfigFields
 * @package esas\cmsgate\view\admin
 */
abstract class ManagedFieldsFactory
{
    /**
     * Массив всех полей
     * @var ConfigField[]
     */
    protected $allFields;
    protected $fieldsGroupedByForm;

    /**
     * @var Logger
     */
    protected $logger;

    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));
        $this->initFields();
    }

    public abstract function initFields();

    protected function registerField(ConfigField $configField, $configForm = AdminViewFields::CONFIG_FORM_COMMON)
    {
        $this->allFields[$configField->getKey()] = $configField;
        $this->fieldsGroupedByForm[$configForm][] = $configField;
    }

    /**
     * Метод позвоялет по ключу параметра, определить его тип
     * @param $key
     * @return ConfigField
     */
    public function getFieldByKey($key)
    {
        if ($this->allFields == null || !array_key_exists($key, $this->allFields))
            $this->logger->error("Can not get descriptor for configField[" . $key . ']');
        return $this->allFields[$key];
    }

    /**
     * @param $configForm
     * @return ManagedFields
     * @throws Exception
     */
    public function getManagedFields($configForm) {
        return $this->getManagedFieldsExcept($configForm, array());
    }

    /**
     * @param $configForm
     * @param array $exclude
     * @return ManagedFields
     * @throws Exception
     */
    public function getManagedFieldsExcept($configForm, array $exclude)
    {
        if ($this->fieldsGroupedByForm == null || !array_key_exists($configForm, $this->fieldsGroupedByForm))
            throw new Exception('Wrong config form name[' . $configForm . ']');
        $mangedFields = new ManagedFields();
        foreach ($this->allFields as $configField) {
            if (!in_array($configField->getKey(), $exclude)) {
                $mangedFields->addField($configField);
            }
        }
        return $mangedFields;
    }

}
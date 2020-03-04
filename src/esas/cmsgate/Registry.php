<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 01.10.2018
 * Time: 11:35
 */

namespace esas\cmsgate;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\messenger\Messenger;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\view\admin\ConfigForm;
use esas\cmsgate\wrappers\ConfigWrapper;
use esas\cmsgate\wrappers\OrderWrapper;
use esas\cmsgate\wrappers\SystemSettingsWrapper;

/**
 * Реализация шаблона registry для удобства доступа к ConfigurationWrapper, OrderWrapper, Translator и т.д..
 * В каждой CMS должен быть обязательно наследован и проинициализирован через Registry->init()
 * Class Registry
 * @package esas\cmsgate
 */
abstract class Registry
{
    protected $configWrapper;
    protected $systemSettingsWrapper;
    protected $translator;
    protected $configForm;
    protected $messenger;

    public function init() {
        $registryName = self::getUniqRegistryName();
        global $$registryName;
        if ($$registryName == null) {
//            Logger::getLogger(get_class($this))->debug("init");
            $$registryName = $this;
        }
    }

    /**
     * В случае, если в CMS одновеременно установлено несколько cmsgate плагинов,
     * Registry каждого должны быть сохранен в global под разными именами
     * Для уникальности генерируем хэш по пути текущего файла
     * @return string
     */
    private static function getUniqRegistryName() {
        return "cmsRegistry_" . hash('md5', getcwd());
    }

    /**
     * @return ConfigWrapper
     */
    public function getConfigWrapper()
    {
        if ($this->configWrapper == null)
            $this->configWrapper = $this->createConfigWrapper();
        return $this->configWrapper;
    }
    
    public abstract function createConfigWrapper();

    /**
     * @return SystemSettingsWrapper
     */
    public function getSystemSettingsWrapper()
    {
        if ($this->systemSettingsWrapper == null)
            $this->systemSettingsWrapper = $this->createSystemSettingsWrapper();
        return $this->systemSettingsWrapper;
    }

    public function createSystemSettingsWrapper() {
        return new SystemSettingsWrapper();
    }

    /**
     * @return Translator
     */
    public function getTranslator()
    {
        if ($this->translator == null)
            $this->translator = $this->createTranslator();
        return $this->translator;
    }

    public abstract function createTranslator();

    /**
     * @return Registry
     */
    public static function getRegistry() {
        /**
         * @var \esas\cmsgate\Registry $esasRegistry
         */
        $registryName = self::getUniqRegistryName();
        global $$registryName;
        if ($$registryName == null) {
            Logger::getLogger("registry")->fatal("CMSGate registry is not initialized!");
        }
        return $$registryName;
    }

    /**
     * По локальному номеру счета (номеру заказа) возвращает wrapper
     * @param $orderId
     * @return OrderWrapper
     */
    public abstract function getOrderWrapper($orderId);

    /**
     * Получение формы с настройками сделано через Registry, т.к. в некоторых CMS создание формы и ее валидация разнесены в разные хуки
     * @return ConfigForm
     */
    public function getConfigForm()
    {
        if ($this->configForm == null)
            $this->configForm = $this->createConfigForm();
        return $this->configForm;
    }

    public abstract function createConfigForm();

    /**
     * Машинное название платежной системы
     * @return string
     */
    public abstract function getPaySystemName();

    /**
     * @return Messenger
     */
    public function getMessenger()
    {
        if ($this->messenger == null)
            $this->messenger = new Messenger($this->createTranslator());
        return $this->messenger;
    }
}
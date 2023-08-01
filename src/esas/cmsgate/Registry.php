<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 01.10.2018
 * Time: 11:35
 */

namespace esas\cmsgate;


use esas\cmsgate\descriptors\ModuleDescriptor;
use esas\cmsgate\lang\Translator;
use esas\cmsgate\messenger\Messenger;
use esas\cmsgate\properties\Properties;
use esas\cmsgate\service\Service;
use esas\cmsgate\service\ServiceProvider;
use esas\cmsgate\utils\CMSGateException;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\utils\SessionUtils;
use esas\cmsgate\view\admin\AdminViewFields;
use esas\cmsgate\view\admin\ConfigForm;
use esas\cmsgate\view\admin\ManagedFieldsFactory;
use esas\cmsgate\wrappers\ConfigWrapper;
use esas\cmsgate\wrappers\OrderWrapper;
use esas\cmsgate\wrappers\SystemSettingsWrapper;
use Exception;

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
    /**
     * @var ModuleDescriptor
     */
    protected $moduleDescriptor;
    /**
     * @var CmsConnector
     */
    protected $cmsConnector;
    /**
     * @var PaysystemConnector
     */
    protected $paysystemConnector;
    /**
     * @var ManagedFieldsFactory
     */
    protected $managedFieldsFactory;
    /**
     * @var Hooks
     */
    protected $hooks;
    /**
     * @var ConfigStorageCms
     */
    protected $configStorage;

    /**
     * @var array
     */
    protected $services = array();

    /**
     * @var array
     */
    protected $servicesPostConstructed = array();

    /**
     * @var Properties
     */
    protected $properties;

    public function init() {
        $registryName = self::getUniqRegistryName();
        global $$registryName;
        if ($$registryName == null) {
            $$registryName = $this;
        }
        if ($this->cmsConnector != null)
            $this->cmsConnector->init();
        if ($this->paysystemConnector != null)
            $this->paysystemConnector->init();
    }

    /**
     * В случае, если в CMS одновеременно установлено несколько cmsgate плагинов,
     * Registry каждого должны быть сохранен в global под разными именами
     * Для уникальности генерируем хэш по пути текущего файла
     * @return string
     */
    private static function getUniqRegistryName() {
        return "cmsRegistry_" . hash('md5', __FILE__);
    }

    /**
     * @return ConfigWrapper
     */
    public function getConfigWrapper() {
        if ($this->configWrapper == null)
            $this->configWrapper = $this->createConfigWrapper();
        return $this->configWrapper;
    }

    public function flushConfigWrapper() {
        $this->configWrapper = null;
        $this->configStorage = null;
    }

    public function createConfigWrapper() {
        return $this->paysystemConnector->createConfigWrapper();
    }

    /**
     * @return ManagedFieldsFactory
     */
    public function getManagedFieldsFactory() {
        if ($this->managedFieldsFactory == null)
            $this->managedFieldsFactory = $this->createManagedFieldsFactory();
        return $this->managedFieldsFactory;
    }

    /**
     * @return ManagedFieldsFactory
     */
    public function createManagedFieldsFactory() {
        return $this->paysystemConnector->createManagedFieldsFactory();
    }

    /**
     * @return SystemSettingsWrapper
     */
    public function getSystemSettingsWrapper() {
        if ($this->systemSettingsWrapper == null)
            $this->systemSettingsWrapper = $this->createSystemSettingsWrapper();
        return $this->systemSettingsWrapper;
    }

    public function createSystemSettingsWrapper() {
        return $this->cmsConnector->createSystemSettingsWrapper();
    }

    /**
     * @return Translator
     */
    public function getTranslator() {
        if ($this->translator == null)
            $this->translator = $this->createTranslator();
        return $this->translator;
    }

    public function createTranslator() {
        return $this->paysystemConnector->createTranslator();
    }

    /**
     * @return Registry
     */
    public static function getRegistry() {
        /**
         * @var $esasRegistry
         */
        $registryName = self::getUniqRegistryName();
        global $$registryName;
        if ($$registryName == null) {
            Logger::getLogger("registry")->fatal("CMSGate registry is not initialized!");
        }
        return $$registryName;
    }

    /**
     * По локальному id заказа возвращает wrapper
     * @param $orderId
     * @return OrderWrapper
     * @throws Exception если не удается получить
     */
    public function getOrderWrapper($orderId) {
        if (empty($orderId))
            throw new Exception('Incorrect orderId');
        $orderWrapper = $this->cmsConnector->createOrderWrapperByOrderId($orderId);
        if ($orderWrapper == null)
            throw new Exception('Can not get orderWrapper by given orderId[' . $orderId . "]");
        return $orderWrapper;
    }

    /**
     * По локальному номеру заказа (может отличаться от id) возвращает wrapper
     * @param $orderNumber
     * @return OrderWrapper
     * @throws Exception
     */
    public function getOrderWrapperByOrderNumber($orderNumber) {
        if (empty($orderNumber))
            throw new Exception('Incorrect orderNumber');
        $orderWrapper = $this->cmsConnector->createOrderWrapperByOrderNumber($orderNumber);
        if ($orderWrapper == null)
            throw new Exception('Can not get orderWrapper by given orderNumber[' . $orderNumber . "]");
        return $orderWrapper;
    }

    /**
     * @param $orderNumberOrId
     * @return OrderWrapper
     * @throws Exception
     */
    public function getOrderWrapperByOrderNumberOrId($orderNumberOrId) {
        if ($this->getConfigWrapper()->isUseOrderNumber())
            return $this->getOrderWrapperByOrderNumber($orderNumberOrId);
        else
            return $this->getOrderWrapper($orderNumberOrId);
    }

    /**
     * По номеру транзакции внешней система возвращает wrapper
     * @param $extId
     * @return OrderWrapper
     * @throws Exception
     */
    public function getOrderWrapperByExtId($extId) {
        if (empty($extId))
            throw new Exception('Incorrect extId');
        $orderWrapper = $this->cmsConnector->createOrderWrapperByExtId($extId);
        if ($orderWrapper == null)
            throw new Exception('Can not get orderWrapper by given extId[' . $extId . "]");
        return $orderWrapper;
    }

    /**
     * По номеру транзакции внешней система возвращает wrapper
     * @param $extId
     * @return OrderWrapper
     * @throws Exception
     */
    public function getOrderWrapperForCurrentUser() {
        $orderWrapper = $this->cmsConnector->createOrderWrapperForCurrentUser();
        if ($orderWrapper == null)
            throw new Exception('Can not get orderWrapper for current order of current user');
        return $orderWrapper;
    }

    /**
     * Получение формы с настройками сделано через Registry, т.к. в некоторых CMS создание формы и ее валидация разнесены в разные хуки
     * @return ConfigForm
     */
    public function getConfigForm() {
        if ($this->configForm != null)
            return $this->configForm;
        else if (SessionUtils::getForm(AdminViewFields::CONFIG_FORM_COMMON) != null)
            $this->configForm = SessionUtils::getForm(AdminViewFields::CONFIG_FORM_COMMON);
        else
            $this->configForm = $this->createConfigForm();
        return $this->configForm;
    }

    public abstract function createConfigForm();

    /**
     * @return ConfigForm[]
     */
    public function getConfigFormsArray() {
        return array($this->getConfigForm());
    }

    /**
     * Машинное название платежной системы
     * @return string
     */
    public function getPaySystemName() {
        return $this->getPaysystemConnector()->getPaySystemConnectorDescriptor()->getPaySystemMachinaName();
    }

    /**
     * @return Messenger
     */
    public function getMessenger() {
        if ($this->messenger == null)
            $this->messenger = new Messenger($this->createTranslator());
        return $this->messenger;
    }

    public function createLocaleLoader() {
        return $this->cmsConnector->createLocaleLoader();
    }

    /**
     * @return ConfigStorageCms
     */
    public function getConfigStorage() {
        if ($this->configStorage == null)
            $this->configStorage = $this->createConfigStorage();
        return $this->configStorage;
    }

    public function createConfigStorage() {
        return $this->cmsConnector->createConfigStorage();
    }

    /**
     * @return CmsConnector
     */
    public function getCmsConnector() {
        return $this->cmsConnector;
    }

    /**
     * @return PaysystemConnector
     */
    public function getPaysystemConnector() {
        return $this->paysystemConnector;
    }

    /**
     * @return ModuleDescriptor
     */
    public function getModuleDescriptor() {
        if ($this->moduleDescriptor == null)
            $this->moduleDescriptor = $this->createModuleDescriptor();
        return $this->moduleDescriptor;
    }

    public abstract function createModuleDescriptor();

    /**
     * Метод позволяет задать нередактируемые значения настроек
     * @param $key
     * @return null
     */
    public function getConstantConfigValue($key) {
        return $this->getConfigStorage()->getConstantConfigValue($key);
    }

    /**
     * @return Hooks
     */
    public function getHooks() {
        if ($this->hooks == null)
            $this->hooks = $this->createHooks();
        return $this->hooks;
    }

    /**
     * @return Hooks
     */
    public function createHooks() {
        return $this->paysystemConnector->createHooks();
    }

    /**
     * @param $serviceProvider ServiceProvider
     */
    public function registerServicesFromProvider($serviceProvider) {
        foreach ($serviceProvider->getServiceArray() as $key => $value)
            $this->registerService($key, $value);
    }

    public function registerService($serviceParentClass, $serviceInstance) {
        $this->services[$serviceParentClass] = $serviceInstance;
    }

    /**
     * @param $serviceParentClass
     * @param $defaultServiceImpl
     * @return Service
     * @throws CMSGateException
     */
    public function getService($serviceParentClass, $defaultServiceImpl = null) {
        /** @var Service $service */
        $service = $defaultServiceImpl;
        if (array_key_exists($serviceParentClass, $this->services))
            $service = $this->services[$serviceParentClass];
        if ($service == null)
            throw new CMSGateException("Service[" . $serviceParentClass . "] is not configured");
        if (!array_key_exists($serviceParentClass, $this->services))
            $this->registerService($serviceParentClass, $service);
        if (!array_key_exists(get_class($service), $this->servicesPostConstructed)) {
            $service->postConstruct();
            $this->servicesPostConstructed[get_class($service)] = true;
        }
        return $service;
    }

    /**
     * @return Properties
     */
    public function getProperties() {
        if ($this->properties == null)
            $this->properties = $this->createProperties();
        return $this->properties;
    }

    /**
     * @return Properties
     */
    public function createProperties() {
        throw new CMSGateException('Not implemented');
    }
}
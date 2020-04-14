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
use esas\cmsgate\utils\SessionUtils;
use esas\cmsgate\view\admin\AdminViewFields;
use esas\cmsgate\view\admin\ConfigForm;
use esas\cmsgate\wrappers\ConfigWrapper;
use esas\cmsgate\wrappers\OrderWrapper;
use esas\cmsgate\wrappers\OrderWrapperFactory;
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
     * @var CmsConnector
     */
    protected $cmsConnector;

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
        return $this->cmsConnector->createSystemSettingsWrapper();
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
        $orderWrapper =  $this->cmsConnector->createOrderWrapperByOrderId($orderId);
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
        $orderWrapper = $this->cmsConnector->createOrderWrapperByOrderNumber($orderNumber);
        if ($orderWrapper == null)
            throw new Exception('Can not get orderWrapper by given orderТгьиук[' . $orderNumber . "]");
        return $orderWrapper;
    }

    /**
     * По номеру транзакции внешней система возвращает wrapper
     * @param $extId
     * @return OrderWrapper
     * @throws Exception
     */
    public function getOrderWrapperByExtId($extId) {
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
    public function getConfigForm()
    {
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

    public function createLocaleLoader() {
        return $this->cmsConnector->createLocaleLoader();
    }

    public function createConfigStorage() {
        return $this->cmsConnector->createConfigStorage();
    }

    /**
     * @return CmsConnector
     */
    public function getCmsConnector()
    {
        return $this->cmsConnector;
    }
}
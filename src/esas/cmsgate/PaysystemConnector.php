<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 14.04.2020
 * Time: 13:41
 */

namespace esas\cmsgate;


use esas\cmsgate\descriptors\PaySystemConnectorDescriptor;
use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\view\admin\ManagedFieldsFactory;
use esas\cmsgate\wrappers\ConfigWrapper;

/**
 * Class PaysystemConnector позволяющий решить проблему множественного неследования в Registry. Часть объектов, создаваемых в
 * Registry относятся к платежной системе (PaySystem), а часть к Cms. Для упрощения создания таких объектов, созданы два
 * класса: CmsConnector и PaysystemConnector.
 * @package esas\cmsgate
 */
abstract class PaysystemConnector
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var PaySystemConnectorDescriptor
     */
    protected $paySystemConnectorDescriptor;

    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));
    }

    public function init() {}

    /**
     * @return ConfigWrapper
     */
    public abstract function createConfigWrapper();

    /**
     * @return Translator
     */
    public abstract function createTranslator();

    /**
     * @return ManagedFieldsFactory
     */
    public abstract function createManagedFieldsFactory();


    /**
     * @return Hooks
     */
    public abstract function createHooks();

    /**
     * @return PaySystemConnectorDescriptor
     */
    public function getPaySystemConnectorDescriptor()
    {
        if ($this->paySystemConnectorDescriptor == null)
            $this->paySystemConnectorDescriptor = $this->createPaySystemConnectorDescriptor();
        return $this->paySystemConnectorDescriptor;
    }

    public abstract function checkAuth($login, $password, $sandbox);

    public abstract function createPaySystemConnectorDescriptor();
}
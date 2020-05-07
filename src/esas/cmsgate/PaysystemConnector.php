<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 14.04.2020
 * Time: 13:41
 */

namespace esas\cmsgate;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\view\admin\ManagedFieldsFactory;
use esas\cmsgate\wrappers\ConfigWrapper;

abstract class PaysystemConnector
{
    /**
     * @var Logger
     */
    protected $logger;

    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));
    }

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
}
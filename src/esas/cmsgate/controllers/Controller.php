<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 06.06.2018
 * Time: 14:21
 */

namespace esas\cmsgate\controllers;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\Logger;

abstract class Controller
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));
        $this->logger->info("ModuleDescriptor: \n\t"
            . Registry::getRegistry()->getModuleDescriptor() . "\n\t"
            . Registry::getRegistry()->getPaysystemConnector()->getPaySystemConnectorDescriptor() . "\n\t"
            . Registry::getRegistry()->getCmsConnector()->getCmsConnectorDescriptor());
    }

}
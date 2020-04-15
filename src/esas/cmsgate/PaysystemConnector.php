<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 14.04.2020
 * Time: 13:41
 */

namespace esas\cmsgate;


use esas\cmsgate\utils\Logger;

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

    public abstract function createConfigWrapper();

    public abstract function createTranslator();
}
<?php


namespace esas\cmsgate\service;


use esas\cmsgate\utils\Logger;

abstract class Service
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Service constructor.
     */
    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));
    }

    /**
     * @return $this
     */
    public static abstract function fromRegistry();

    public function postConstruct() {}
}
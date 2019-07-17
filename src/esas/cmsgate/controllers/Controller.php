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
use esas\cmsgate\wrappers\ConfigWrapper;

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
    }

}
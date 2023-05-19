<?php


namespace esas\cmsgate\service;


use esas\cmsgate\Registry;

abstract class PDOService extends Service
{
    /**
     * @inheritDoc
     */
    public static function fromRegistry() {
        return Registry::getRegistry()->getService(PDOService::class);
    }

    public abstract function getPDO($repositoryClass = null);
}
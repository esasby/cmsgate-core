<?php


namespace esas\cmsgate\hro\pages;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class AdminLoginPageHROFactory implements HROFactory
{
    /**
     * @return AdminLoginPageHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(AdminLoginPageHRO::class, AdminLoginPageHRO_v1::class);
    }
}
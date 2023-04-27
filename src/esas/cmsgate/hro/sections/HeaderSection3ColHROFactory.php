<?php


namespace esas\cmsgate\hro\sections;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class HeaderSection3ColHROFactory implements HROFactory
{
    /**
     * @return HeaderSection3ColHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(HeaderSection3ColHRO::class, HeaderSection3ColHRO_v1::class);
    }
}
<?php


namespace esas\cmsgate\hro\typography;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class DescriptionListHROFactory implements HROFactory
{
    /**
     * @return DescriptionListHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(DescriptionListHRO::class, DescriptionListHRO_v1::class);
    }
}
<?php


namespace esas\cmsgate\hro\tables;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class DataListHROFactory implements HROFactory
{
    /**
     * @return DataListHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(DataListHRO::class, DataListHRO_v1::class);
    }
}
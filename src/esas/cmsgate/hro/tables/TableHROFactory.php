<?php


namespace esas\cmsgate\hro\tables;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class TableHROFactory implements HROFactory
{
    /**
     * @return TableHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(TableHRO::class, TableHRO_v1::class);
    }
}
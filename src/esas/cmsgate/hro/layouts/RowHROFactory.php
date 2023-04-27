<?php


namespace esas\cmsgate\hro\layouts;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class RowHROFactory implements HROFactory
{
    /**
     * @return RowHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(RowHRO::class, RowHRO_v1::class);
    }
}
<?php


namespace esas\cmsgate\hro\layouts;


use esas\cmsgate\hro\forms\FormButtonHRO;
use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class ColHROFactory implements HROFactory
{
    /**
     * @return ColHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(ColHRO::class, ColHRO_v1::class);
    }

}
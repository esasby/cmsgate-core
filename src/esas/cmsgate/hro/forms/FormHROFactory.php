<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class FormHROFactory implements HROFactory
{
    /**
     * @return FormHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(FormHRO::class, FormHRO_v2::class);
    }
}
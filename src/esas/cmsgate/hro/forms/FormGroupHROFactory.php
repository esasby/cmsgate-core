<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class FormGroupHROFactory implements HROFactory
{
    /**
     * @return FormGroupHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(FormGroupHRO::class, FormGroupHRO_v1::class);
    }
}
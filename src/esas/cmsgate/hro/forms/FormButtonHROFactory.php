<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class FormButtonHROFactory implements HROFactory
{
    /**
     * @return FormButtonHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(FormButtonHRO::class, FormButtonHRO_v1::class);
    }
}
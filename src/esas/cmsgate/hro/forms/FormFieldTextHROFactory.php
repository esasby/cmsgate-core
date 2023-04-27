<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class FormFieldTextHROFactory implements HROFactory
{
    /**
     * @return FormFieldTextHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(FormFieldTextHRO::class, FormFieldTextHRO_v1::class);
    }
}
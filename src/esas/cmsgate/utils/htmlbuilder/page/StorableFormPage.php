<?php


namespace esas\cmsgate\utils\htmlbuilder\page;


use esas\cmsgate\ConfigStorageCms;

interface StorableFormPage extends SingleFormPage
{
    /**
     * @return ConfigStorageCms
     */
    public function getStorage();
}
<?php


namespace esas\cmsgate\utils\htmlbuilder\page;


use esas\cmsgate\view\admin\ManagedFields;

interface SingleFormPage extends AbstractPage
{
    /**
     * @return ManagedFields
     */
    public function getFormFields();
}
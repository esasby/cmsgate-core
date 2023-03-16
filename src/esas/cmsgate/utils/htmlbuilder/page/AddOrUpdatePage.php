<?php


namespace esas\cmsgate\utils\htmlbuilder\page;


interface AddOrUpdatePage extends SingleFormPage
{
    public function isEditMode();
}
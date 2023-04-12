<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\forms;


interface FormFieldTextHRO extends FormFieldHRO
{
    /**
     * @param $onFieldAction
     * @return FormFieldTextHRO
     */
    public function addOnFieldAction($onFieldAction);
}
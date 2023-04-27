<?php


namespace esas\cmsgate\hro\forms;


interface FormFieldTextHRO extends FormFieldHRO
{
    /**
     * @param $onFieldAction
     * @return FormFieldTextHRO
     */
    public function addOnFieldAction($onFieldAction);
}
<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\hro\HRO;

interface FormButtonHRO extends HRO
{
    /**
     * @param $type
     * @return FormButtonHRO
     */
    public function setType($type);

    /**
     * @param $onClick
     * @return FormButtonHRO
     */
    public function setOnClick($onClick);

    /**
     * @param $label
     * @return FormButtonHRO
     */
    public function setLabel($label, $translate = true);

}
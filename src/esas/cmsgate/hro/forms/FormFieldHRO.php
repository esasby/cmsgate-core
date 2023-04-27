<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\hro\HRO;
use esas\cmsgate\view\admin\fields\ConfigField;

interface FormFieldHRO extends HRO
{
    /**
     * @param ConfigField $field
     * @return $this
     */
    public function setFieldDescriptor(ConfigField $field);

    /**
     * @param $oneRow boolean
     * @return $this
     */
    public function setOneRow($oneRow);
}
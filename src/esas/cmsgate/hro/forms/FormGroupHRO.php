<?php


namespace esas\cmsgate\hro\forms;

use esas\cmsgate\hro\HRO;
use esas\cmsgate\view\admin\fields\ConfigField;

interface FormGroupHRO extends HRO
{
    /**
     * @param ConfigField $configField
     * @return FormGroupHRO
     */
    public function setField(ConfigField $configField);

    /**
     * @param $input
     * @return FormGroupHRO
     */
    public function setInput($input);

    /**
     * @param $oneRow boolean
     * @return FormGroupHRO
     */
    public function setOneRow($oneRow);

    /**
     * @param $extraElements
     * @return FormGroupHRO
     */
    public function addExtraElements($extraElements);
}
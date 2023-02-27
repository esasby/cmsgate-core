<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\forms;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\hro\HRO;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;

class FormFieldTextHRO implements FormField, HRO
{

    public static function builder() {
        return new FormFieldTextHRO();
    }

    public function build() {
        return bootstrap::formGroup(
            self::elementLabel($configField),
            element::div(
                attribute::clazz("col"),
                $input,
                self::elementInputValidationDetails($configField)
            ),
            $extraElements
        );
    }
}
<?php

use esas\cmsgate\view\admin\AdminViewFields;
const _DESC = '_desc';
const _DEFAULT = '_default';
const _ERROR_VALIDATION = 'error_validation_';


return array(
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNotEmpty::class => 'Value can not be empty',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorInteger::class => 'Value had to be between %d and %d',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNumeric::class => 'Value had to be numeric',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorEmail::class => 'Wrong email format',

    AdminViewFields::CONFIG_FORM_COMMON_HEADING => 'Common settings',
);
<?php

use esas\cmsgate\ConfigurationFields;
use esas\cmsgate\view\client\ViewFields;

const _DESC = '_desc';
const _DEFAULT = '_default';
const _ERROR_VALIDATION = 'error_validation_';


return array(
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNotEmpty::class => 'Value can not be empty',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorInteger::class => 'Value had to be between %d and %d',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNumeric::class => 'Value had to be numeric',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorEmail::class => 'Wrong email format',
);
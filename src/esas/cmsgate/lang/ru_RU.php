<?php

use esas\cmsgate\view\admin\AdminViewFields;
const _DESC = '_desc';
const _DEFAULT = '_default';
const _ERROR_VALIDATION = 'error_validation_';

return array(
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNotEmpty::class => 'Значение не может быть пустым',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorInteger::class => 'Значение должно быть число в диапазоне от %d до %d',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNumeric::class => 'Значение должно быть целым числом',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorEmail::class => 'Неверный формат email',

    AdminViewFields::CONFIG_FORM_COMMON_HEADING => 'Общие настройки',
);
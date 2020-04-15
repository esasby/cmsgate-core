<?php

use esas\cmsgate\ConfigFields;
use esas\cmsgate\messenger\Messages;
use esas\cmsgate\utils\RequestParams;
use esas\cmsgate\view\admin\AdminViewFields;
use esas\cmsgate\view\ViewFields;

if (!defined("_DESC")) define("_DESC", '_desc');
if (!defined("_DEFAULT")) define("_DEFAULT", '_default');
if (!defined("_ERROR_VALIDATION")) define("_ERROR_VALIDATION", 'error_validation_');

return array(
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNotEmpty::class => 'Value can not be empty',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorInteger::class => 'Value had to be between %d and %d',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNumeric::class => 'Value had to be numeric',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorEmail::class => 'Wrong email format',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorUploadFileExtension::class => 'Wrong file extension. *.[%s] file is expected',

    ConfigFields::debugMode() => 'Debug mode',
    ConfigFields::debugMode() . _DESC => 'Debug mode. If *true* then extra messages will be shown',

    AdminViewFields::CONFIG_FORM_COMMON => 'Common settings',
    AdminViewFields::SETTINGS => 'Settings',

    ViewFields::BUTTON_CONTINUE => 'Continue',

    RequestParams::SAVE_BUTTON => 'Save',
    RequestParams::SAVE_AND_EXIT_BUTTON => 'Save and exit',

    Messages::GENERAL_MODULE_ERROR => "General module error",
    Messages::INCORRECT_INPUT => "Incorrect input",
    Messages::SETTINGS_SAVED => "Settings were successfully saved!",
    Messages::SANDBOX_MODE_IS_ON => 'Payment Gateway in \'Sandbox \'. Funds from your account will not be removed.',

);
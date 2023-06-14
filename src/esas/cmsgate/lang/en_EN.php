<?php

use esas\cmsgate\ConfigFields;
use esas\cmsgate\messenger\Messages;
use esas\cmsgate\view\admin\AdminViewFields;
use esas\cmsgate\view\client\ClientViewFields;
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
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorDateTime::class => 'Wrong datetime format. *.[%s] must be used',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorDateTimeLocal::class => 'Wrong datetime format.',

    ConfigFields::debugMode() => 'Debug mode',
    ConfigFields::debugMode() . _DESC => 'Debug mode. If *true* then extra messages will be shown',

    ConfigFields::useOrderNumber() => 'Use order number',
    ConfigFields::useOrderNumber() . _DESC => 'If *true* then bill will be added to the payment gate with local "order number", otherwise "order id" will be used',


    AdminViewFields::CONFIG_FORM_COMMON => 'Common settings',
    AdminViewFields::CONFIG_FORM_BUTTON_SAVE => 'Save',
    AdminViewFields::CONFIG_FORM_BUTTON_SAVE_AND_EXIT => 'Save and exit',
    AdminViewFields::CONFIG_FORM_BUTTON_CANCEL => 'Cancel',
    AdminViewFields::CONFIG_FORM_BUTTON_DOWNLOAD_LOG => 'Download logs',
    AdminViewFields::SETTINGS => 'Settings',
    AdminViewFields::LOGOUT => 'Logout',
    AdminViewFields::CANCEL => 'Cancel',
    AdminViewFields::DELETE => 'Delete',
    AdminViewFields::ADD => 'Add',
    AdminViewFields::COPY => 'Copy',

    ViewFields::BUTTON_CONTINUE => 'Continue',
    ViewFields::BUTTON_CONFIRM => 'Confirm',

    Messages::GENERAL_MODULE_ERROR => "General module error",
    Messages::INCORRECT_INPUT => "Incorrect input",
    Messages::SETTINGS_SAVED => "Settings were successfully saved!",
    Messages::SANDBOX_MODE_IS_ON => 'Payment Gateway in \'Sandbox \'. Funds from your account will not be removed.',

    ClientViewFields::COMPLETION_PAGE_ORDER_PENDING_HEADER => 'Order payment',
    ClientViewFields::COMPLETION_PAGE_ORDER_PENDING_HEADER_DETAILS => 'You need to pay bill',
    ClientViewFields::COMPLETION_PAGE_ORDER_PAYED_HEADER => 'Order is already payed',
    ClientViewFields::COMPLETION_PAGE_ORDER_PAYED_HEADER_DETAILS => 'Order has been paid successfully',
    ClientViewFields::COMPLETION_PAGE_ORDER_PAYED_ALERT => 'Order #<strong>@order_number_or_id</strong> is already payed',
    ClientViewFields::COMPLETION_PAGE_ORDER_FAILED_HEADER => 'Order payment failed',
    ClientViewFields::COMPLETION_PAGE_ORDER_FAILED_HEADER_DETAILS => 'Order can not be paid',
    ClientViewFields::COMPLETION_PAGE_ORDER_FAILED_ALERT => 'Some error has occurred. Order #<strong>@order_number_or_id</strong> was not paid',
    ClientViewFields::COMPLETION_PAGE_ORDER_CANCELED_HEADER => 'Order was canceled',
    ClientViewFields::COMPLETION_PAGE_ORDER_CANCELED_HEADER_DETAILS => 'Order can not be paid',
    ClientViewFields::COMPLETION_PAGE_ORDER_CANCELED_ALERT => 'Order #<strong>@order_number_or_id</strong> was canceled',
    ClientViewFields::COMPLETION_PAGE_ORDER_UNKNOWN_STATUS_ALERT => 'Order #<strong>@order_number_or_id</strong>: incorrect status',
    ClientViewFields::COMPLETION_ERROR_PAGE_HEADER_DETAILS => 'Order confirmation failed',
    ClientViewFields::COMPLETION_PAGE_FOOTER_ABOUT => 'About',
    ClientViewFields::COMPLETION_PAGE_FOOTER_ADDRESS => 'Address',
    ClientViewFields::COMPLETION_PAGE_FOOTER_CONTACTS => 'Contacts',
    ClientViewFields::COMPLETION_PAGE_RETURN_TO_SHOP_BUTTON => 'Back to the store',

    ClientViewFields::ERROR => "Error",
    ClientViewFields::ERROR_APOLOGIZING => "Sorry, payment can not be finished!",

    ClientViewFields::SHIPMENT => 'Shipment',
    ClientViewFields::BACK => 'Back',
    ClientViewFields::PLACE_ORDER => 'Place order',
    ClientViewFields::CONTACTS => "Contacts"
);
<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 17.08.2018
 * Time: 11:09
 */

namespace esas\cmsgate\view\admin;

use esas\cmsgate\view\ViewFields;

/**
 * Перечисление полей, доступных на странице настроек плагина
 * Class AdminViewFields
 * @package sas\cmsgate\view\admin
 */
class AdminViewFields extends ViewFields
{
    const ADMIN_PAYMENT_METHOD_NAME = 'admin_payment_method_name';
    const ADMIN_PAYMENT_METHOD_DESCRIPTION = 'admin_payment_method_description';
    const SETTINGS = 'settings';
    const CONFIG_FORM_COMMON = 'configform_common';
    const CONFIG_FORM_BUTTON_SAVE = 'configform_save';
    const CONFIG_FORM_BUTTON_SAVE_AND_EXIT = 'configform_save_and_exit';
    const CONFIG_FORM_BUTTON_CANCEL = 'configform_cancel';
    const CONFIG_FORM_BUTTON_DOWNLOAD_LOG = 'configform_download_log';
    const LOGOUT = 'logout';
    const CANCEL = 'cancel';
    const DELETE = 'delete';
    const ADD = 'add';
    const COPY = 'copy';
}
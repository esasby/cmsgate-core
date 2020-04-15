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
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNotEmpty::class => 'Значение не может быть пустым',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorInteger::class => 'Значение должно быть число в диапазоне от %d до %d',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNumeric::class => 'Значение должно быть целым числом',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorEmail::class => 'Неверный формат email',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorUploadFileExtension::class => 'Некорректное расширение файла. Ожидается *.[%s] файл',

    ConfigFields::debugMode() => 'Debug mode',
    ConfigFields::debugMode() . _DESC => 'Отображение деталей ошибок',

    AdminViewFields::CONFIG_FORM_COMMON => 'Общие настройки',
    AdminViewFields::SETTINGS => 'Настройки',

    ViewFields::BUTTON_CONTINUE => 'Продолжить',

    RequestParams::SAVE_BUTTON => 'Сохранить',
    RequestParams::SAVE_AND_EXIT_BUTTON => 'Сохранить и выйти',

    Messages::GENERAL_MODULE_ERROR => "Ошибка работы модуля",
    Messages::INCORRECT_INPUT => "Некорректные данные",
    Messages::SETTINGS_SAVED => "Настройки успешно сохранены!",
    Messages::SANDBOX_MODE_IS_ON => 'Внимание! Модуль включен в режиме тестирования. Средства с вашего счёта списываться не будут',

);
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
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNotEmpty::class => 'Значение не может быть пустым',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorInteger::class => 'Значение должно быть число в диапазоне от %d до %d',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorNumeric::class => 'Значение должно быть числом',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorEmail::class => 'Неверный формат email',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorUploadFileExtension::class => 'Некорректное расширение файла. Ожидается *.[%s] файл',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorDateTime::class => 'Некорректный формат даты. Допустимый формат [%s]',
    _ERROR_VALIDATION . esas\cmsgate\view\admin\validators\ValidatorDateTimeLocal::class => 'Некорректный формат даты.',

    ConfigFields::debugMode() => 'Debug mode',
    ConfigFields::debugMode() . _DESC => 'Отображение деталей ошибок',

    ConfigFields::useOrderNumber() => 'Использовать номер заказа',
    ConfigFields::useOrderNumber() . _DESC => 'Если включен, то на платежный шлюз будет отправлен локальным номером заказа (orderNumber), иначе - локальным идентификатор (orderId)',


    AdminViewFields::CONFIG_FORM_COMMON => 'Общие настройки',
    AdminViewFields::CONFIG_FORM_BUTTON_DOWNLOAD_LOG => 'Скачать логи',
    AdminViewFields::CONFIG_FORM_BUTTON_SAVE => 'Сохранить',
    AdminViewFields::CONFIG_FORM_BUTTON_SAVE_AND_EXIT => 'Сохранить и выйти',
    AdminViewFields::CONFIG_FORM_BUTTON_CANCEL => 'Отмена',
    AdminViewFields::SETTINGS => 'Настройки',
    AdminViewFields::LOGOUT => 'Выход',
    AdminViewFields::CANCEL => 'Отмена',
    AdminViewFields::DELETE => 'Удалить',
    AdminViewFields::ADD => 'Добавить',
    AdminViewFields::COPY => 'Копировать',

    ViewFields::BUTTON_CONTINUE => 'Продолжить',
    ViewFields::BUTTON_CONFIRM => 'Подтвердить',

    Messages::GENERAL_MODULE_ERROR => "Ошибка работы модуля",
    Messages::INCORRECT_INPUT => "Некорректные данные",
    Messages::SETTINGS_SAVED => "Настройки успешно сохранены!",
    Messages::SANDBOX_MODE_IS_ON => 'Внимание! Модуль включен в режиме тестирования. Средства с вашего счёта списываться не будут',
    
    Messages::ERROR_CURL_NOT_INSTALLED => 'Для работы модуля необходима библиотека curl',

    ClientViewFields::COMPLETION_PAGE_ORDER_PENDING_HEADER => 'Оплата заказа',
    ClientViewFields::COMPLETION_PAGE_ORDER_PENDING_HEADER_DETAILS => 'Для завершения оформления заказа необходимо оплатить счет',
    ClientViewFields::COMPLETION_PAGE_ORDER_PAYED_HEADER => 'Заказ оплачен',
    ClientViewFields::COMPLETION_PAGE_ORDER_PAYED_HEADER_DETAILS => 'Заказ оплачен успешно',
    ClientViewFields::COMPLETION_PAGE_ORDER_PAYED_ALERT => 'Заказ №<strong>@order_number_or_id</strong> успешно оплачен',
    ClientViewFields::COMPLETION_PAGE_ORDER_FAILED_HEADER => 'Ошибка оплаты',
    ClientViewFields::COMPLETION_PAGE_ORDER_FAILED_HEADER_DETAILS => 'Заказ не может быть оплачен',
    ClientViewFields::COMPLETION_PAGE_ORDER_FAILED_ALERT => 'Произошла ошибка при оплате заказа №<strong>@order_number_or_id</strong>',
    ClientViewFields::COMPLETION_PAGE_ORDER_CANCELED_HEADER => 'Заказ отменен',
    ClientViewFields::COMPLETION_PAGE_ORDER_CANCELED_HEADER_DETAILS => 'Заказ не может быть оплачен',
    ClientViewFields::COMPLETION_PAGE_ORDER_CANCELED_ALERT => 'Заказ №<strong>@order_number_or_id</strong> был отменен',
    ClientViewFields::COMPLETION_PAGE_ORDER_UNKNOWN_STATUS_ALERT => 'Некорректный статус заказ №<strong>@order_number_or_id</strong>. Обратитесь к администратору',
    ClientViewFields::COMPLETION_ERROR_PAGE_HEADER_DETAILS => 'Ошибка оформления заказа',
    ClientViewFields::COMPLETION_PAGE_FOOTER_ABOUT => 'О компании',
    ClientViewFields::COMPLETION_PAGE_FOOTER_ADDRESS => 'Адрес',
    ClientViewFields::COMPLETION_PAGE_FOOTER_CONTACTS => 'Контакты',
    ClientViewFields::COMPLETION_PAGE_RETURN_TO_SHOP_BUTTON => 'Назад в магазин',

    ClientViewFields::ERROR => "Ошибка",
    ClientViewFields::ERROR_APOLOGIZING => "Извините, во время оплаты заказа, возникли проблемы",

    ClientViewFields::SHIPMENT => 'Доставка',
    ClientViewFields::BACK => 'Назад',
    ClientViewFields::PLACE_ORDER => 'Оформить заказ',
    ClientViewFields::CONTACTS => "Контакты"
);
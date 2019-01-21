<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 17.08.2018
 * Time: 11:09
 */

namespace esas\cmsgate\view\client;

/**
 * Перечисление полей, доступных на странице успешного выставления счета
 * Class ViewFields
 * @package esas\cmsgate\view
 */
class ViewFields
{
    const INSTRUCTIONS_TAB_LABEL = 'cmsgate_instructions_tab_label';
    const INSTRUCTIONS = 'cmsgate_instructions_text';
    const QRCODE_TAB_LABEL = 'cmsgate_qrcode_tab_label';
    const QRCODE_DETAILS = 'cmsgate_qrcode_details';
    const ALFACLICK_TAB_LABEL = 'cmsgate_alfaclick_tab_label';
    const ALFACLICK_DETAILS = 'cmsgate_alfaclick_details';
    const ALFACLICK_BUTTON_LABEL = 'cmsgate_alfaclick_button_label';
    const ALFACLICK_MSG_SUCCESS = 'cmsgate_alfaclick_msg_success';
    const ALFACLICK_MSG_UNSUCCESS = 'cmsgate_alfaclick_msg_unsuccess';
    const WEBPAY_TAB_LABEL = 'cmsgate_webpay_tab_label';
    const WEBPAY_DETAILS = 'cmsgate_webpay_details';
    const WEBPAY_BUTTON_LABEL = 'cmsgate_webpay_button_label';
    const WEBPAY_MSG_SUCCESS = 'cmsgate_webpay_msg_success';
    const WEBPAY_MSG_UNSUCCESS = 'cmsgate_webpay_msg_unsuccess';
    const WEBPAY_MSG_UNAVAILABLE = 'cmsgate_webpay_msg_unavailable';
}
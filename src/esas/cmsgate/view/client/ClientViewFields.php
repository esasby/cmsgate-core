<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 14.04.2020
 * Time: 14:59
 */

namespace esas\cmsgate\view\client;


use esas\cmsgate\view\ViewFields;

class ClientViewFields extends ViewFields
{
    const ERROR = 'error';
    const ERROR_APOLOGIZING = 'error_apologizing';
    const COMPLETION_PAGE_ORDER_PENDING_HEADER = 'completion_page_order_pending_header';
    const COMPLETION_PAGE_ORDER_PENDING_HEADER_DETAILS = 'completion_page_order_pending_header_details';
    const COMPLETION_PAGE_ORDER_PAYED_HEADER = 'completion_page_order_payed_header';
    const COMPLETION_PAGE_ORDER_PAYED_HEADER_DETAILS = 'completion_page_order_payed_header_details';
    const COMPLETION_PAGE_ORDER_PAYED_ALERT = 'completion_page_order_payed_alert';
    const COMPLETION_PAGE_ORDER_FAILED_HEADER = 'completion_page_order_failed_header';
    const COMPLETION_PAGE_ORDER_FAILED_HEADER_DETAILS = 'completion_page_order_failed_header_details';
    const COMPLETION_PAGE_ORDER_FAILED_ALERT = 'completion_page_order_failed_alert';
    const COMPLETION_PAGE_ORDER_CANCELED_HEADER = 'completion_page_order_canceled_header';
    const COMPLETION_PAGE_ORDER_CANCELED_HEADER_DETAILS = 'completion_page_order_canceled_header_details';
    const COMPLETION_PAGE_ORDER_CANCELED_ALERT = 'completion_page_order_canceled_alert';
    const COMPLETION_PAGE_ORDER_UNKNOWN_STATUS_ALERT = 'completion_page_order_unknown_status_alert';
    const COMPLETION_ERROR_PAGE_HEADER_DETAILS = 'completion_error_page_header_details';
    const COMPLETION_PAGE_FOOTER_ABOUT = 'completion_page_footer_about';
    const COMPLETION_PAGE_FOOTER_ADDRESS = 'completion_page_footer_address';
    const COMPLETION_PAGE_FOOTER_CONTACTS = 'completion_page_header_contacts';
    const COMPLETION_PAGE_TITLE = 'completion_page_title';
    const COMPLETION_PAGE_RETURN_TO_SHOP_BUTTON = 'completion_page_return_to_shop_button';
    const SHIPMENT = 'shipment';
    const BACK = 'back';
    const PLACE_ORDER = 'make_order';
}
<?php


namespace esas\cmsgate\utils\htmlbuilder\presets;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\properties\ViewProperties;
use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class BootstrapPreset
{
    public static function isBootstrapV4() {
        return Registry::getRegistry()->getProperties()->getBootstrapVersion() == ViewProperties::BOOTSTRAP_V4;
    }

    public static function isBootstrapV5() {
        return Registry::getRegistry()->getProperties()->getBootstrapVersion() == ViewProperties::BOOTSTRAP_V5;
    }

    public static function formGroup(...$elementAndAttributes) {
        return element::div(
            self::isBootstrapV4() ? attribute::clazz("form-group row") : attribute::clazz("row mb-3"),
            $elementAndAttributes);
    }

    public static function elementNavBarList(...$elements) {
        return element::ul(
            attribute::clazz("navbar-nav mr-auto"),
            $elements);
    }

    public static function elementNavBarListItem($href, $label, $active = false) {
        return element::li(
            attribute::clazz("nav-item" . (self::isBootstrapV4() && $active ? " active" : "")),
            element::a(
                attribute::clazz("nav-link" . (self::isBootstrapV5() && $active ? " active" : "")),
                attribute::href($href),
                $label
            )
        );
    }

    const ALERT_TYPE_INFO = "alert-info";
    const ALERT_TYPE_DANGER = "alert-danger";
    const ALERT_TYPE_WARNING = "alert-warning";
    const ALERT_TYPE_SUCCESS = "alert-success";

    public static function elementAlertInfo($message) {
        return self::elementAlert($message, self::ALERT_TYPE_INFO);
    }

    public static function elementAlertError($message) {
        return self::elementAlert($message, self::ALERT_TYPE_DANGER);
    }

    public static function elementAlertWarn($message) {
        return self::elementAlert($message, self::ALERT_TYPE_WARNING);
    }

    public static function elementAlertSuccess($message) {
        return self::elementAlert($message, self::ALERT_TYPE_SUCCESS);
    }

    public static function elementAlert($message, $class) {
        return
            element::div(
                attribute::clazz("alert alert-dismissible " . $class),
                $message,
                self::elementAlertDismiss()
            );
    }

    public static function elementAlertDismiss() {
        return
            element::button(
                attribute::type('button'),
                attribute::clazz(self::isBootstrapV5() ? 'btn-close' : 'close'),
                self::isBootstrapV5() ? attribute::data_bs_dismiss('alert') : attribute::data_dismiss('alert'),
                element::span(
                    attribute::aria_hidden(),
                    '&times;'
                )
            );
    }

    public static function elementCard(...$elementAndAttributes) {
        return
            element::div(
                attribute::clazz('card card-default'),
                $elementAndAttributes
            );
    }

    public static function elementCardHeader(...$elementAndAttributes) {
        return
            element::div(
                attribute::clazz('card-header'),
                $elementAndAttributes
            );
    }

    public static function elementCardBody(...$elementAndAttributes) {
        return
            element::div(
                attribute::clazz('card-body'),
                $elementAndAttributes
            );
    }

    public static function elementCardFooter(...$elementAndAttributes) {
        return
            element::div(
                attribute::clazz('card-footer'),
                $elementAndAttributes
            );
    }

    public static function elementContainer(...$elementAndAttributes) {
        return
            element::div(
                attribute::clazz('container'),
                $elementAndAttributes
            );
    }

    public static function elementRow(...$elementAndAttributes) {
        return
            element::div(
                attribute::clazz('row'),
                $elementAndAttributes
            );
    }

    public static function elementRowExt($extClass, ...$elementAndAttributes) {
        return
            element::div(
                attribute::clazz('row ' . $extClass),
                $elementAndAttributes
            );
    }

    public static function elementCol(...$elementAndAttributes) {
        return
            element::div(
                attribute::clazz('col'),
                $elementAndAttributes
            );
    }

    public static function elementColX($colX, ...$elementAndAttributes) {
        return
            element::div(
                attribute::clazz('col-' . $colX),
                $elementAndAttributes
            );
    }

    public static function elementDiv($class, ...$elementAndAttributes) {
        return
            element::div(
                attribute::clazz($class),
                $elementAndAttributes
            );
    }

    public static function elementPMuted(...$elementAndAttributes) {
        return
            element::p(
                attribute::clazz('text-muted'),
                $elementAndAttributes);
    }

    public static function elementCardFooterButtons(...$elementAndAttributes) {
        return
            element::div(
                attribute::clazz("row"),
                element::div(
                    attribute::clazz("col col-sm-12 d-flex justify-content-end"),
                    $elementAndAttributes
                )
            );
    }

    public static function elementAButton($label, $href, $classAppend = '') {
        return
            element::a(
                attribute::href($href),
                attribute::clazz('btn me-1 ' . $classAppend),
                element::content($label)
            );
    }

    public static function elementClickablePhone($phone, ...$elementAndAttributes) {
        return self::elementClickablePhoneExt('', $phone, $elementAndAttributes);
    }

    public static function elementClickablePhoneExt($extClass, $phone, ...$elementAndAttributes) {
        return
            element::a(
                attribute::href('tel:' . $phone),
                attribute::clazz($extClass),
                $elementAndAttributes == null ? $phone : $elementAndAttributes
            );
    }

    public static function elementClickableEmail($email, ...$elementAndAttributes) {
        return self::elementClickablePhoneExt('', $email, $elementAndAttributes);
    }

    public static function elementClickableEmailExt($extClass, $email, ...$elementAndAttributes) {
        return
            element::a(
                attribute::href('mailto:' . $email),
                attribute::clazz($extClass),
                $elementAndAttributes == null ? $email : $elementAndAttributes
            );
    }

    public static function elementAHrefNoDecoration($label, $href, $classAppend = '') {
        return
            element::a(
                attribute::href($href),
                attribute::clazz("text-decoration-none " . $classAppend),
                element::content($label)
            );
    }

    public static function elementAHref($label, $href, $classAppend = '') {
        return
            element::a(
                attribute::href($href),
                attribute::clazz($classAppend),
                element::content($label)
            );
    }

    public static function elementInputHidden($key, $value) {
        return element::input(
            attribute::name($key),
            attribute::type('hidden'),
            attribute::id($key),
            attribute::value($value)
        );
    }

    public static function elementButtonSubmit($label, $classAppend = '') {
        return
            element::button(
                attribute::type('submit'),
                attribute::clazz('btn me-1 ' . $classAppend),
                element::content($label)
            );
    }

    public static function elementTableHead($labelsArray, $translate = true) {
        $headColArray = array();
        foreach ($labelsArray as $label) {
            $headColArray[] = self::elementTableHeadCol($translate ? Translator::fromRegistry()->translate($label) : $label);
        }
        return element::thead(
            element::tr(
                $headColArray
            )
        );
    }

    public static function elementTableHeadCol($label) {
        return element::th(
            attribute::scope("col"),
            element::content($label)
        );
    }
}
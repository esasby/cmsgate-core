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

    public static function elementAlertInfo($message)
    {
        return self::elementAlert($message, "alert-info");
    }

    public static function elementAlertError($message)
    {
        return self::elementAlert($message, "alert-danger");
    }

    public static function elementAlertWarn($message)
    {
        return self::elementAlert($message, "alert-warning");
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

    public static function elementCardFooterButton($label, $href, $classAppend = '') {
        return
            element::a(
            attribute::href($href),
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
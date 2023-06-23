<?php


namespace esas\cmsgate\hro\accordions;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

/**
 * Version based on CSS accordion
 * @package esas\cmsgate\hro\accordions
 */
class AccordionTabHRO_v2 extends AccordionTabHRO_v1
{
    public static function builder() {
        return new AccordionTabHRO_v2();
    }

    public function build() {
        return
            element::div(
                attribute::id("tab-" . $this->key),
                attribute::clazz("tab " . $this->getCssClass4Tab()),
                $this->elementTabHeaderInput($this->key),
                $this->elementTabHeader($this->key, $this->header),
                $this->elementTabBody($this->key, $this->body)
            );
    }

    public function elementTabHeaderInput($key, $selectable = true) {
        return
            ($selectable ? element::input(
                attribute::id("input-" . $key),
                attribute::type("radio"),
                attribute::name("tabs2"),
                attribute::checked($this->checked)
            ) : "");
    }

    public function elementTabHeader($key, $header) {
        return
            element::div(
                attribute::clazz("tab-header " . $this->getCssClass4TabHeader()),
                element::label(
                    attribute::forr("input-" . $key),
                    attribute::clazz($this->getCssClass4TabHeaderLabel()),
                    element::content($header)
                )
            );
    }

    public function elementTabBody($key, $body) {
        return
            element::div(
                attribute::clazz("tab-body " . $this->getCssClass4TabBody()),
                element::div(
                    attribute::id($key . "-content"),
                    attribute::clazz("tab-body-content " . $this->getCssClass4TabBodyContent()),
                    element::content($body)
                )
            );
    }

    /**
     * @return string
     */
    public function getCssClass4Tab() {
        return "";
    }

    /**
     * @return string
     */
    public function getCssClass4TabHeader() {
        return "";
    }

    /**
     * @return string
     */
    public function getCssClass4TabHeaderLabel() {
        return "";
    }

    /**
     * @return string
     */
    public function getCssClass4TabBody() {
        return "";
    }

    /**
     * @return string
     */
    public function getCssClass4TabBodyContent() {
        return "";
    }
}
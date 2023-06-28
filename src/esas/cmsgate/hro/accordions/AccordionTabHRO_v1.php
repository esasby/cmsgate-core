<?php


namespace esas\cmsgate\hro\accordions;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class AccordionTabHRO_v1 implements AccordionTabHRO
{
    protected $key;
    protected $header;
    protected $body;
    /**
     * @var boolean
     */
    protected $checked;
    protected $parentId;
    /**
     * @var boolean
     */
    protected $onlyOneTabEnabled;

    public function setKey($key) {
        $this->key = $key;
        return $this;
    }

    public function setHeader($header) {
        $this->header = $header;
        return $this;
    }

    public function setBody($body) {
        $this->body = $body;
        return $this;
    }

    public function setChecked($checked) {
        $this->checked = $checked;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setParentId($parentId, $forceOverride = false) {
        if (empty($this->parentId) || $forceOverride)
            $this->parentId = $parentId;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setOnlyOneTabEnabled($onlyOneTabEnabled) {
        $this->onlyOneTabEnabled = $onlyOneTabEnabled;
        return $this;
    }

    public static function builder() {
        return new AccordionTabHRO_v1();
    }

    public function build() {
        return
            element::div(
                attribute::clazz("accordion-item"),
                $this->elementTabHeader($this->key, $this->header),
                $this->elementTabBody($this->key, $this->body)
            );
    }

    public function elementTabHeader($key, $header) {
        return
            element::div(
                attribute::clazz("accordion-header"),
                attribute::id($this->getTabHeaderId($key)),
                element::button(
                    attribute::type("button"),
                    attribute::data_bs_toggle("collapse"),
                    attribute::data_bs_target("#" . $this->getTabBodyId($key)),
                    attribute::aria_controls("#" . $this->getTabBodyId($key)),
                    attribute::clazz('accordion-button' . ($this->checked ? "" : " collapsed")),
                    element::content($header)
                )
            );
    }

    public function elementTabBody($key, $body) {
        return
            element::div(
                attribute::id($this->getTabBodyId($key)),
                attribute::clazz("accordion-collapse collapse" . ($this->checked ? " show" : "")),
                attribute::aria_labelledby($this->getTabHeaderId($key)),
                attribute::data_bs_parent($this->parentId),
                element::div(
                    attribute::clazz("accordion-body"),
                    element::content($body)
                )
            );
    }

    public function getTabHeaderId($key) {
        return "heading" . $key;
    }

    public function getTabBodyId($key) {
        return "collapse" . $key;
    }
}
<?php


namespace esas\cmsgate\hro\sections;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;

class HeaderSection3ColHRO_v1 implements HeaderSection3ColHRO
{
    public $elementStartColumn;
    public $elementCenterColumn;
    public $elementEndColumn;

    /**
     * @param mixed $elementStartColumn
     * @return HeaderSection3ColHRO_v1
     */
    public function setElementStartColumn($elementStartColumn) {
        $this->elementStartColumn = $elementStartColumn;
        return $this;
    }

    /**
     * @param mixed $elementCenterColumn
     * @return HeaderSection3ColHRO_v1
     */
    public function setElementCenterColumn($elementCenterColumn) {
        $this->elementCenterColumn = $elementCenterColumn;
        return $this;
    }

    /**
     * @param mixed $elementEndColumn
     * @return HeaderSection3ColHRO_v1
     */
    public function setElementEndColumn($elementEndColumn) {
        $this->elementEndColumn = $elementEndColumn;
        return $this;
    }

    public static function builder() {
        return new HeaderSection3ColHRO_v1();
    }

    public function build() {
        return element::div(
            attribute::id('element-section-header'),
            element::div(
                attribute::clazz("container p-3 text-center"),
                element::content(
                    bootstrap::elementRowExt("gy-3",
                        bootstrap::elementDiv("col-6 col-md-2 text-start",
                            attribute::id("element-header-start-column"),
                            $this->elementStartColumn),
                        bootstrap::elementDiv("col-md-8 d-none d-md-block", //for medium displays
                            attribute::id("element-header-center-column-1"),
                            $this->elementCenterColumn),
                        bootstrap::elementDiv("col-6 col-md-2 text-end",
                            attribute::id("element-header-end-column"),
                            $this->elementEndColumn),
                        bootstrap::elementDiv("col-md-12 d-sm-block d-md-none", //for small displays
                            attribute::id("element-header-center-column-2"),
                            $this->elementCenterColumn)
                    )
                )
            )
        );
    }
}
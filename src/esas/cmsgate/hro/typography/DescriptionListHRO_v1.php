<?php


namespace esas\cmsgate\hro\typography;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class DescriptionListHRO_v1 implements DescriptionListHRO
{
    protected $elementsDtDd = '';
    protected $dtDefaultSize;
    protected $ddDefaultSize;

    /**
     * @inheritDoc
     */
    public function setDtDefaultSize($dtDefaultSize) {
        $this->dtDefaultSize = $dtDefaultSize;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDdDefaultSize($ddDefaultSize) {
        $this->ddDefaultSize = $ddDefaultSize;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addDt($dtText, $colX = null) {
        if ($colX == null)
            $colX = $this->dtDefaultSize;
        $this->elementsDtDd .= element::dt(
            attribute::clazz('col-sm-' . $colX ),
            element::content($dtText)
        );
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addDd($dtText, $colX = null) {
        if ($colX == null)
            $colX = $this->ddDefaultSize;
        $this->elementsDtDd .= element::dd(
            attribute::clazz('col-sm-' . $colX ),
            element::content($dtText)
        );
        return $this;
    }

    public static function builder() {
        return new DescriptionListHRO_v1();
    }

    public function build() {
        return element::dl(
            attribute::clazz('row'),
            $this->elementsDtDd
        );
    }
}
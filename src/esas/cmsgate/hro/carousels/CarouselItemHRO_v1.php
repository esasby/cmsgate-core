<?php


namespace esas\cmsgate\hro\carousels;

use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class CarouselItemHRO_v1 implements CarouselItemHRO
{
    protected $imageUrl;
    protected $caption;
    protected $active;
    protected $extClass;

    /**
     * @inheritDoc
     */
    public function setImage($imageUrl) {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCaption($caption) {
        $this->caption = $caption;
        return $this;
    }

    public function setActive($active = true) {
        $this->active = $active;
        return $this;
    }

    public function setExtClass($extClass) {
        $this->extClass = $extClass;
        return $this;
    }

    public static function builder() {
        return new CarouselItemHRO_v1();
    }

    public function build() {
        return
            element::div(
                attribute::clazz("carousel-item" . ($this->active ? " active" : "")),
                element::div(
                    attribute::clazz("container " . $this->extClass),
                    element::img(
                        attribute::src($this->imageUrl),
                        attribute::clazz("d-block w-100")
                    ),
                    $this->elementCaption()
                )
            );
    }

    public function elementCaption() {
        if (empty($this->caption))
            return "";
        return
            element::div(
                attribute::clazz("carousel-caption d-none d-md-block"),
                element::p($this->caption)
            );
    }

}
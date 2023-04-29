<?php


namespace esas\cmsgate\hro\carousels;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class CarouselHRO_v1 implements CarouselHRO
{
    protected $id;
    protected $items;
    protected $tabsCount = 0;
    protected $showIndicators = true;
    protected $showDark = false;

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function addItem($item) {
        $this->items[] = $item;
        $this->tabsCount++;
        return $this;
    }

    public function showIndicators($showIndicators = true) {
        $this->showIndicators = $showIndicators;
        return $this;
    }

    public function showDark($showDark = true) {
        $this->showDark = $showDark;
        return $this;
    }

    public static function builder() {
        return new CarouselHRO_v1();
    }

    public function build() {
        return
            element::div(
                attribute::id($this->id),
                attribute::clazz('carousel slide' . ($this->showDark ? " carousel-dark" : "")),
                attribute::data_bs_ride('carousel'),
                $this->elementIndicators(),
                element::div(
                    attribute::clazz("carousel-inner"),
                    $this->items),
                $this->elementCarouselControl("prev"),
                $this->elementCarouselControl("next")
            );
    }

    public function elementCarouselControl($direction) {
        return
            element::button(
                attribute::clazz("carousel-control-" . $direction),
                attribute::type('button'),
                attribute::data_bs_target("#" . $this->id),
                attribute::data_bs_slide($direction),
                element::span(
                    attribute::clazz("carousel-control-" . $direction . "-icon"),
                    attribute::aria_hidden()
                ),
                element::span(
                    attribute::clazz("visually-hidden"),
                    $direction
                )
            );
    }

    public function elementIndicators() {
        if (!$this->showIndicators)
            return "";
        $indicatorsButtons = '';
        for ($i = 0; $i < $this->tabsCount; $i++)
            $indicatorsButtons .=
                element::button(
                    attribute::type('button'),
                    attribute::data_bs_target("#" . $this->id),
                    attribute::data_bs_slide_to($i),
                    attribute::aria_label("Slide " . ($i + 1)),
                    ($i == 0 ? attribute::clazz('active') : ""),
                    ($i == 0 ? attribute::aria_current() : "")
                );
        return
            element::div(
                attribute::clazz("carousel-indicators"),
                $indicatorsButtons
            );
    }
}
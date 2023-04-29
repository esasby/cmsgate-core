<?php


namespace esas\cmsgate\hro\carousels;


use esas\cmsgate\hro\HRO;

interface CarouselHRO extends HRO
{
    /**
     * @param mixed $id
     * @return CarouselHRO
     */
    public function setId($id);

    /**
     * @param boolean $showIndicators
     * @return CarouselHRO
     */
    public function showIndicators($showIndicators = true);

    /**
     * @param boolean $showDark
     * @return CarouselHRO
     */
    public function showDark($showDark = true);

    /**
     * @param $item
     * @return CarouselHRO
     */
    public function addItem($item);
}
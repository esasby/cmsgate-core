<?php


namespace esas\cmsgate\hro\carousels;


use esas\cmsgate\hro\HRO;

interface CarouselItemHRO extends HRO
{
    /**
     * @param mixed $imageUrl
     * @return CarouselItemHRO
     */
    public function setImage($imageUrl);

    /**
     * @param mixed $caption
     * @return CarouselItemHRO
     */
    public function setCaption($caption);

    /**
     *
     * @param mixed $extraClass
     * @return CarouselItemHRO
     */
    public function setExtClass($extraClass);

    /**
     * @param mixed $active
     * @return CarouselItemHRO
     */
    public function setActive($active = true);


}
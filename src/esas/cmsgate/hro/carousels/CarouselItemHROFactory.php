<?php


namespace esas\cmsgate\hro\carousels;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class CarouselItemHROFactory implements HROFactory
{
    /**
     * @return CarouselItemHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(CarouselItemHRO::class, CarouselItemHRO_v1::class);
    }
}
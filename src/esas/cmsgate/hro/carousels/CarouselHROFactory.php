<?php


namespace esas\cmsgate\hro\carousels;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class CarouselHROFactory implements HROFactory
{
    /**
     * @return CarouselHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(CarouselHRO::class, CarouselHRO_v1::class);
    }
}
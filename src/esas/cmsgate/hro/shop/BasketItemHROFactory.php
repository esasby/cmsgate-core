<?php


namespace esas\cmsgate\hro\shop;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class BasketItemHROFactory implements HROFactory
{
    /**
     * @return BasketItemHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(BasketItemHRO::class, BasketItemHRO_v1::class);
    }
}
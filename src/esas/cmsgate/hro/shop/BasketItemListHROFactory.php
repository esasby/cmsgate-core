<?php


namespace esas\cmsgate\hro\shop;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class BasketItemListHROFactory implements HROFactory
{
    /**
     * @return BasketItemListHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(BasketItemListHRO::class, BasketItemListHRO_v1::class);
    }
}
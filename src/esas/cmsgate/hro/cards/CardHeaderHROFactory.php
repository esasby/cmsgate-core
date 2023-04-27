<?php


namespace esas\cmsgate\hro\cards;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class CardHeaderHROFactory implements HROFactory
{
    /**
     * @return CardHeaderHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(CardHeaderHRO::class, CardHeaderHRO_v1::class);
    }
}
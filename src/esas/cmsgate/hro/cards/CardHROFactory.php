<?php


namespace esas\cmsgate\hro\cards;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class CardHROFactory implements HROFactory
{
    /**
     * @return CardHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(CardHRO::class, CardHRO_v1::class);
    }
}
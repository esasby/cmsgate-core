<?php


namespace esas\cmsgate\hro\cards;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class CardFooterHROFactory implements HROFactory
{
    /**
     * @return CardFooterHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(CardFooterHRO::class, CardFooterHRO_v1::class);
    }
}
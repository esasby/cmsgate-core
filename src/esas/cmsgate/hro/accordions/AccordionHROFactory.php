<?php


namespace esas\cmsgate\hro\accordions;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class AccordionHROFactory implements HROFactory
{
    /**
     * @return AccordionHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(AccordionHRO::class, AccordionHRO_v1::class);
    }
}
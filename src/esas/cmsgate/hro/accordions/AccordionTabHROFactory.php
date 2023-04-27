<?php


namespace esas\cmsgate\hro\accordions;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class AccordionTabHROFactory implements HROFactory
{
    /**
     * @return AccordionTabHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(AccordionTabHRO::class, AccordionTabHRO_v1::class);
    }
}
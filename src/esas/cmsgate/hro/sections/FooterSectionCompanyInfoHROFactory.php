<?php


namespace esas\cmsgate\hro\sections;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class FooterSectionCompanyInfoHROFactory implements HROFactory
{
    /**
     * @return FooterSectionCompanyInfoHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(FooterSectionCompanyInfoHRO::class, FooterSectionCompanyInfoHRO_v1::class);
    }
}
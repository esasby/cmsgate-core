<?php


namespace esas\cmsgate\hro\sections;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class HeaderSectionLogoContactsHROFactory implements HROFactory
{
    /**
     * @return HeaderSectionLogoContactsHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(HeaderSectionLogoContactsHRO::class, HeaderSectionLogoContactsHRO_v1::class);
    }
}
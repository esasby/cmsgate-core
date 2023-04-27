<?php


namespace esas\cmsgate\hro\pages;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class ClientOrderCompletionPageHROFactory implements HROFactory
{
    /**
     * @return ClientOrderCompletionPageHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(ClientOrderCompletionPageHRO::class, ClientOrderCompletionPageHRO_v1::class);
    }
}
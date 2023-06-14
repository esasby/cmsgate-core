<?php


namespace esas\cmsgate\hro\panels;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class MessagesPanelHROFactory implements HROFactory
{
    /**
     * @return CopyToClipboardPanelHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(MessagesPanelHRO::class, MessagesPanelHRO_v1::class);
    }
}
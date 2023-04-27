<?php


namespace esas\cmsgate\hro\panels;


use esas\cmsgate\hro\HROFactory;
use esas\cmsgate\hro\HROManager;

class CopyToClipboardPanelHROFactory implements HROFactory
{
    /**
     * @return CopyToClipboardPanelHRO
     */
    public static function findBuilder() {
        return HROManager::fromRegistry()->getImplementation(CopyToClipboardPanelHRO::class, CopyToClipboardPanelHRO_v1::class);
    }
}
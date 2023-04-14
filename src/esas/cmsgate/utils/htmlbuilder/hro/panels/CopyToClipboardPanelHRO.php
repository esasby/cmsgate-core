<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\panels;

use esas\cmsgate\utils\htmlbuilder\hro\HRO;

interface CopyToClipboardPanelHRO extends HRO
{
    /**
     * @param mixed $labelId
     * @return CopyToClipboardPanelHRO
     */
    public function setLabelId($labelId);

    /**
     * @param mixed $value
     * @return CopyToClipboardPanelHRO
     */
    public function setValue($value);

    public function addButton($elementButton);
}
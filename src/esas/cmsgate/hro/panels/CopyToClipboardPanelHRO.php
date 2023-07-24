<?php


namespace esas\cmsgate\hro\panels;

use esas\cmsgate\hro\HRO;

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

    /**
     * @param $elementButton
     * @return CopyToClipboardPanelHRO
     */
    public function addButton($elementButton);
}
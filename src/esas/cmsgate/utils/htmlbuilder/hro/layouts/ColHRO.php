<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\layouts;
use esas\cmsgate\utils\htmlbuilder\hro\HRO;

interface ColHRO extends HRO
{
    /**
     * @param mixed $verticalAlignment
     * @return RowHRO
     */
    public function setVerticalAlignment($verticalAlignment);

    /**
     * @param mixed $element
     * @return ColHRO
     */
    public function addElement($element);
}
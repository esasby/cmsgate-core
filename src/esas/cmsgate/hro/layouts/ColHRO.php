<?php


namespace esas\cmsgate\hro\layouts;
use esas\cmsgate\hro\HRO;

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
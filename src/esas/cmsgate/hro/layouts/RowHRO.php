<?php


namespace esas\cmsgate\hro\layouts;
use esas\cmsgate\hro\HRO;

interface RowHRO extends HRO
{
    /**
     * @param mixed $horizontalAlignment
     * @return RowHRO
     */
    public function setHorizontalAlignment($horizontalAlignment);

    /**
     * @param mixed $verticalAlignment
     * @return RowHRO
     */
    public function setVerticalAlignment($verticalAlignment);

    /**
     * @param mixed $element
     * @return RowHRO
     */
    public function addElement($element);
}
<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\sections;

use esas\cmsgate\utils\htmlbuilder\hro\HRO;

interface HeaderSection3ColHRO extends HRO
{
    /**
     * @param mixed $startBlock
     * @return HeaderSection3ColHRO
     */
    public function setElementStartColumn($startBlock);

    /**
     * @param mixed $centerBlock
     * @return HeaderSection3ColHRO
     */
    public function setElementCenterColumn($centerBlock);

    /**
     * @param mixed $endBlock
     * @return HeaderSection3ColHRO
     */
    public function setElementEndColumn($endBlock);
}
<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\tables;

use esas\cmsgate\utils\htmlbuilder\hro\HRO;

interface TableHRO extends HRO
{
    /**
     * @param $tableHeader
     * @return $this
     */
    public function setTableHeader($tableHeader);

    /**
     * @param $labelsArray
     * @param bool $translate
     * @return $this
     */
    public function setTableHeaderColumns($labelsArray, $translate = false);

    /**
     * @param mixed $tableBody
     * @return $this
     */
    public function setTableBody($tableBody);


}
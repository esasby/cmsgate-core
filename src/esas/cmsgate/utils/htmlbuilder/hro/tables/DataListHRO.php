<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\tables;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\hro\HRO;
use esas\cmsgate\utils\htmlbuilder\hro\HROFactory;
use esas\cmsgate\view\admin\AdminViewFields;

interface DataListHRO extends HRO
{
    /**
     * @param $headerLabel
     * @param bool $translate
     * @return DataListHRO
     */
    public function setMainLabel($headerLabel, $translate = true);

    /**
     * @param $tableHeaderColumns
     * @return DataListHRO
     */
    public function setTableHeaderColumns($tableHeaderColumns);

    /**
     * @param $tableBody
     * @return DataListHRO
     */
    public function setTableBody($tableBody) ;

    /**
     * @param $label
     * @param $href
     * @param $classAppend
     * @param bool $translate
     * @return DataListHRO
     */
    public function addFooterButton($label, $href, $classAppend, $translate = true);

    /**
     * @param $href
     * @return DataListHRO
     */
    public function addFooterButtonAdd($href);

    /**
     * @param $label
     * @param $href
     * @param $classAppend
     * @param bool $translate
     * @return DataListHRO
     */
    public function addHeaderButton($label, $href, $classAppend, $translate = true);
}
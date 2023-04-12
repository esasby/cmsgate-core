<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\accordions;


use esas\cmsgate\utils\htmlbuilder\hro\HRO;

interface AccordionHRO extends HRO
{
    /**
     * @param mixed $id
     * @return AccordionHRO
     */
    public function setId($id);

    /**
     * @param $tab
     * @return AccordionHRO
     */
    public function addTab($tab);
}
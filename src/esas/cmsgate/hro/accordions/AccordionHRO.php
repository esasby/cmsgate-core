<?php


namespace esas\cmsgate\hro\accordions;


use esas\cmsgate\hro\HRO;

interface AccordionHRO extends HRO
{
    /**
     * @param mixed $id
     * @return AccordionHRO
     */
    public function setId($id);

    /**
     * @param $tab AccordionTabHRO
     * @return AccordionHRO
     */
    public function addTab($tab);
}
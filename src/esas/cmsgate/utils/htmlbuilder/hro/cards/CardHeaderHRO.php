<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\cards;


use esas\cmsgate\utils\htmlbuilder\hro\HRO;

/**
 * @package esas\cmsgate\utils\htmlbuilder\hro\cards
 */
interface CardHeaderHRO extends HRO
{
    /**
     * @param $label
     * @param bool $translate
     * @return $this
     */
    public function setLabel($label, $translate = true) ;

    /**
     * @param $label
     * @param $href
     * @param $classAppend
     * @param bool $translateLabel
     * @return $this
     */
    public function addButton($label, $href, $classAppend, $translateLabel = false);
}
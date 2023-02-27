<?php


namespace esas\cmsgate\utils\htmlbuilder\hro;


/**
 * Interface HRO - Html rendered object
 * @package esas\cmsgate\utils\htmlbuilder\hro
 */
interface HRO
{
    public static function builder();

    public function build();
}
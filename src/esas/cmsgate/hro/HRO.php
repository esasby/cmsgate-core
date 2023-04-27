<?php


namespace esas\cmsgate\hro;


/**
 * Interface HRO - Html rendered object
 * @package esas\cmsgate\hro
 */
interface HRO
{
    public static function builder();

    public function build();
}
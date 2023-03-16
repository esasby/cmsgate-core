<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\cards;

use esas\cmsgate\utils\htmlbuilder\hro\HRO;

interface CardFormHRO extends HRO
{
    public function addFooterButton($label, $href, $classAppend = '') ;

    public function addHeaderButton($label, $href, $classAppend = '');

}
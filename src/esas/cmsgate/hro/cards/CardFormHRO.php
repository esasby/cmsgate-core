<?php


namespace esas\cmsgate\hro\cards;

use esas\cmsgate\hro\HRO;

interface CardFormHRO extends HRO
{
    public function addFooterButton($label, $href, $classAppend = '') ;

    public function addHeaderButton($label, $href, $classAppend = '');

}
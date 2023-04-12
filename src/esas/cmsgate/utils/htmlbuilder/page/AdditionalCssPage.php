<?php


namespace esas\cmsgate\utils\htmlbuilder\page;


interface AdditionalCssPage extends AbstractPage
{
    public function addCssLink($additionalCss);
}
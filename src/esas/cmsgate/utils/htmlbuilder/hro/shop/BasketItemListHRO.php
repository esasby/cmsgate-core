<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\shop;


use esas\cmsgate\utils\htmlbuilder\hro\HRO;

interface BasketItemListHRO extends HRO
{
    /**
     * @param $basketItem
     * @return BasketItemListHRO
     */
    public function addItem($basketItem);
}
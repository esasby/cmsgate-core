<?php


namespace esas\cmsgate\hro\shop;


use esas\cmsgate\hro\HRO;

interface BasketItemListHRO extends HRO
{
    /**
     * @param $basketItem
     * @return BasketItemListHRO
     */
    public function addItem($basketItem);
}
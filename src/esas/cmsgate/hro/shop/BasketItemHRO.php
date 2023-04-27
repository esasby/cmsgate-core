<?php


namespace esas\cmsgate\hro\shop;


use esas\cmsgate\hro\HRO;

interface BasketItemHRO extends HRO
{
    /**
     * @param mixed $image
     * @return BasketItemHRO
     */
    public function setImage($image);

    /**
     * @param mixed $productId
     * @return BasketItemHRO
     */
    public function setProductId($productId);


    /**
     * @param mixed $productName
     * @return BasketItemHRO
     */
    public function setProductName($productName);

    /**
     * @param mixed $productSKU
     * @return BasketItemHRO
     */
    public function setProductSKU($productSKU);

    /**
     * @param mixed $productDescription
     * @return BasketItemHRO
     */
    public function setProductDescription($productDescription);

    /**
     * @param mixed $price
     * @return BasketItemHRO
     */
    public function setPrice($price);

    /**
     * @param mixed $currency
     * @return BasketItemHRO
     */
    public function setCurrency($currency);

    /**
     * @param mixed $count
     * @return BasketItemHRO
     */
    public function setCount($count);

    /**
     * @param $countInputId
     * @return BasketItemHRO
     */
    public function setCountInputId($countInputId);

    /**
     * @param mixed $maxCount
     * @return BasketItemHRO
     */
    public function setMaxCount($maxCount);

    /**
     * @param mixed $productLink
     * @return BasketItemHRO
     */
    public function setProductLink($productLink);

}
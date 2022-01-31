<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 08.07.2020
 * Time: 12:49
 */

namespace esas\cmsgate\wrappers;


use esas\cmsgate\OrderStatus;
use Throwable;

class OrderWrapperImpl extends OrderWrapper
{
    private $orderId;
    private $clientId;
    private $fullName;
    private $mobilePhone;
    private $email;
    private $address;
    private $amount;
    private $shippingAmount;
    private $currency;
    private $products;
    private $extId;
    private $status;

    /**
     * OrderWrapperImpl constructor.
     * @param $orderId
     * @param $clientId
     * @param $fullName
     * @param $mobilePhone
     * @param $email
     * @param $address
     * @param $amount
     * @param $currency
     * @param $products
     * @param $extId
     * @param $status
     */
    public function __construct($orderId, $clientId, $fullName, $mobilePhone, $email, $address, $amount, $currency, $products, $extId, $status)
    {
        parent::__construct();
        $this->orderId = $orderId;
        $this->clientId = $clientId;
        $this->fullName = $fullName;
        $this->mobilePhone = $mobilePhone;
        $this->email = $email;
        $this->address = $address;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->products = $products;
        $this->extId = $extId;
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     * @return OrderWrapperImpl
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     * @return OrderWrapperImpl
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     * @return OrderWrapperImpl
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * @param mixed $mobilePhone
     * @return OrderWrapperImpl
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return OrderWrapperImpl
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return OrderWrapperImpl
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }


    /**
     * @param mixed $amount
     * @return OrderWrapperImpl
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingAmount()
    {
        return $this->shippingAmount;
    }

    /**
     * @param mixed $shippingAmount
     */
    public function setShippingAmount($shippingAmount)
    {
        $this->shippingAmount = $shippingAmount;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     * @return OrderWrapperImpl
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     * @return OrderWrapperImpl
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtId()
    {
        return $this->extId;
    }

    /**
     * @param mixed $extId
     * @return OrderWrapperImpl
     */
    public function setExtId($extId)
    {
        $this->extId = $extId;
        return $this;
    }

    /**
     * @return OrderStatus mixed
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Обновляет статус заказа в БД
     * @param OrderStatus $newStatus
     * @throws Throwable
     */
    public function updateStatus($newStatus)
    {
        $this->status = $newStatus;
    }

    /**
     * Сохраняет привязку внешнего идентификтора к заказу
     * @param $extId
     */
    public function saveExtId($extId)
    {
        // TODO: Implement saveExtId() method.
    }
}
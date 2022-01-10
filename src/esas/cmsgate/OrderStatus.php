<?php


namespace esas\cmsgate;


class OrderStatus
{
    private $orderStatus;
    private $paymentStatus;

    /**
     * OrderStatus constructor.
     * @param $orderStatus
     * @param $paymentStatus
     */
    public function __construct($orderStatus, $paymentStatus = null)
    {
        $this->orderStatus = $orderStatus;
        $this->paymentStatus = $paymentStatus;
    }

    public function getOrderStatus() {
        return $this->orderStatus;
    }

    public function getPaymentStatus() {
        return $this->paymentStatus;
    }

    public function __toString()
    {
        return $this->orderStatus . ($this->paymentStatus !== '' ? ':' . $this->paymentStatus : '');
    }

    public function equals(OrderStatus $s2) {
        return $s2 != null && $this->orderStatus === $s2->orderStatus && $this->paymentStatus === $s2->paymentStatus;
    }

    public static function pending()
    {
        return new OrderStatus(
            Registry::getRegistry()->getConfigWrapper()->getOrderStatusPending(),
            Registry::getRegistry()->getConfigWrapper()->getOrderPaymentStatusPending());
    }

    public static function payed()
    {
        return new OrderStatus(
            Registry::getRegistry()->getConfigWrapper()->getOrderStatusPayed(),
            Registry::getRegistry()->getConfigWrapper()->getOrderPaymentStatusPending());
    }

    public static function failed()
    {
        return new OrderStatus(
            Registry::getRegistry()->getConfigWrapper()->getOrderStatusFailed(),
            Registry::getRegistry()->getConfigWrapper()->getOrderPaymentStatusFailed());
    }

    public static function canceled()
    {
        return new OrderStatus(
            Registry::getRegistry()->getConfigWrapper()->getOrderStatusCanceled(),
            Registry::getRegistry()->getConfigWrapper()->getOrderPaymentStatusCanceled());
    }
}
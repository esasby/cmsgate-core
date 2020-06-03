<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 27.02.2020
 * Time: 10:59
 */

namespace esas\cmsgate\utils;


class CMSGateException extends \Exception
{
    private $clientMsg;

    /**
     * CMSGateException constructor.
     * @param $clientMsg
     */
    public function __construct($logMessage = "", $clientMsg = "", $code = 0, $previous = null)
    {
        parent::__construct($logMessage, $code, $previous);
        $this->clientMsg = $clientMsg;
    }

    /**
     * @return mixed
     */
    public function getClientMsg()
    {
        return $this->clientMsg;
    }

    /**
     * @param mixed $clientMsg
     */
    public function setClientMsg($clientMsg)
    {
        $this->clientMsg = $clientMsg;
    }

    /**
     * @param $objkectToCheck
     * @param $logMsg
     * @param string $clientMsg
     * @throws CMSGateException
     */
    public static function throwIfNull($objkectToCheck, $logMsg, $clientMsg = "")
    {
        if ($objkectToCheck == null)
            throw new CMSGateException($logMsg, $clientMsg);
    }
}
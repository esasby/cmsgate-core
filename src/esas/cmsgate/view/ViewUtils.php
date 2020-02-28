<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 28.02.2020
 * Time: 12:03
 */

namespace esas\cmsgate\view;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\CMSGateException;
use esas\cmsgate\utils\Logger;

class ViewUtils
{
    public static function logAndGetMsg($loggerName, $ex)
    {
        $clientMsg = '';
        Logger::getLogger($loggerName)->error("Exception:" . $ex->getMessage(), $ex);
        if ($ex instanceof CMSGateException) {
            $clientMsg = Registry::getRegistry()->getTranslator()->translate($ex->getClientMsg());
            if (Registry::getRegistry()->getConfigWrapper()->isDebugMode())
                $clientMsg .= " | " . $ex->getMessage();

        } elseif ($ex instanceof \Exception || $ex instanceof \Throwable) {
            $clientMsg = $ex->getMessage();
        }
        return $clientMsg;
    }
}
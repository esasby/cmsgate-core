<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 03.03.2020
 * Time: 15:58
 */

namespace esas\cmsgate\view;


use esas\cmsgate\Registry;

abstract class ViewBuilder
{
    public static function elementMessages($infoClass, $errorClass, $warnClass) {
        $ret = "";
        $messages = Registry::getRegistry()->getMessenger()->getInfoMessagesArray();
        if (!empty($messages)) {
            foreach ($messages as $message)
                $ret .= static::elementMessage($infoClass, $message);
        }
        $messages = Registry::getRegistry()->getMessenger()->getWarnMessagesArray();
        if (!empty($messages)) {
            foreach ($messages as $message)
                $ret .= static::elementMessage($errorClass, $message); //todo поправить класс
        }
        $messages = Registry::getRegistry()->getMessenger()->getErrorMessagesArray();
        if (!empty($messages)) {
            foreach ($messages as $message)
                $ret .= static::elementMessage($warnClass, $message);
        }
        return $ret;
    }
    
    public abstract static function elementMessage($class, $text);
}
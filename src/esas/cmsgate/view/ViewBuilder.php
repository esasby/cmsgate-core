<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 03.03.2020
 * Time: 15:58
 */

namespace esas\cmsgate\view;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

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

    /**
     * Метод должен быть переопределен
     * @param $class
     * @param $text
     * @return string
     */
    public static function elementMessage($class, $text) {
        return "";
    }

    public static function elementModuleDetailsTable() {
        return element::table(
            element::tr(
                element::td("Module: "),
                element::td(
                    element::a(
                        attribute::href(Registry::getRegistry()->getModuleDescriptor()->getModuleUrl()),
                        element::content(Registry::getRegistry()->getModuleDescriptor()->getModuleMachineName())
                    ))
            ),
            element::tr(
                element::td("Version: "),
                element::td(Registry::getRegistry()->getModuleDescriptor()->getVersion()->getVersion())
            ),
            element::tr(
                element::td("Vendor: "),
                element::td(
                    element::a(
                        attribute::href(Registry::getRegistry()->getModuleDescriptor()->getVendor()->getUrl()),
                        element::content(Registry::getRegistry()->getModuleDescriptor()->getVendor()->getFullName())
                    )
                )
            )
        );
    }
}
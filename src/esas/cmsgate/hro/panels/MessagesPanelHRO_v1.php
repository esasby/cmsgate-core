<?php


namespace esas\cmsgate\hro\panels;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;

class MessagesPanelHRO_v1 implements MessagesPanelHRO
{
    public static function builder() {
        return new MessagesPanelHRO_v1();
    }

    public function build() {
        $ret = "";
        foreach (Registry::getRegistry()->getMessenger()->getErrorMessagesArray() as $message) {
            $ret .= $this->elementAlertError($message);
        }
        foreach (Registry::getRegistry()->getMessenger()->getInfoMessagesArray() as $message) {
            $ret .= $this->elementAlertInfo($message);
        }
        foreach (Registry::getRegistry()->getMessenger()->getSuccessMessagesArray() as $message) {
            $ret .= $this->elementAlertSuccess($message);
        }
        foreach (Registry::getRegistry()->getMessenger()->getWarnMessagesArray() as $message) {
            $ret .= $this->elementAlertWarn($message);
        }
        return $ret;
    }

    protected function elementAlertError($message) {
        return bootstrap::elementAlertError($message);
    }

    protected function elementAlertInfo($message) {
        return bootstrap::elementAlertInfo($message);
    }

    protected function elementAlertSuccess($message) {
        return bootstrap::elementAlertSuccess($message);
    }

    protected function elementAlertWarn($message) {
        return bootstrap::elementAlertWarn($message);
    }
}
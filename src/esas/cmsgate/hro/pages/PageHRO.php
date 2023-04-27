<?php


namespace esas\cmsgate\hro\pages;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\hro\HRO;
use esas\cmsgate\utils\htmlbuilder\page\AbstractPage;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset;
use esas\cmsgate\utils\Logger;

abstract class PageHRO implements HRO, AbstractPage
{
    /**
     * @var Logger
     */
    protected $logger;

    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));
    }

    public function build()
    {
        return '<!DOCTYPE html>'
            . element::html(
                $this->elementPageHead(),
                $this->elementPageBody()
            );
    }

    public function __toString()
    {
        return $this->build();
    }

    public function buildAndDisplay()
    {
        echo $this->build();
    }

    public function render() {
        $this->buildAndDisplay();
    }

    public function elementHeadMetaCharset($charset) {
        return element::meta(
            attribute::charset($charset));
    }

    public abstract function elementPageHead();

    public abstract function getPageTitle();

    public abstract function elementPageBody();

    public static function elementMessages()
    {
        $ret = "";
        foreach (Registry::getRegistry()->getMessenger()->getErrorMessagesArray() as $message) {
            $ret .= BootstrapPreset::elementAlertError($message);
        }
        foreach (Registry::getRegistry()->getMessenger()->getInfoMessagesArray() as $message) {
            $ret .= BootstrapPreset::elementAlertInfo($message);
        }
        foreach (Registry::getRegistry()->getMessenger()->getWarnMessagesArray() as $message) {
            $ret .= BootstrapPreset::elementAlertWarn($message);
        }
        return $ret;
    }
}
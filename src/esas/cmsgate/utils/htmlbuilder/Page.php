<?php


namespace esas\cmsgate\utils\htmlbuilder;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\Logger;

abstract class Page
{
    /**
     * @var Logger
     */
    protected $logger;

    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));
    }

    public function __toString()
    {
        return '<!DOCTYPE html>'
            . element::html(
                $this->elementPageHead(),
                $this->elementPageBody()
            );
    }

    public function render()
    {
        echo $this->__toString();
    }

    public function elementHeadMetaCharset($charset) {
        return element::meta(
            attribute::charset($charset));
    }

    public abstract function elementPageHead();

    public abstract function getPageTitle();

    public abstract function elementPageBody();

    public function aTop() {

    }

    public function elementMessages()
    {
        $ret = "";
        foreach (Registry::getRegistry()->getMessenger()->getErrorMessagesArray() as $message) {
            $ret .= $this->elementErrorMessage($message);
        }
        foreach (Registry::getRegistry()->getMessenger()->getInfoMessagesArray() as $message) {
            $ret .= $this->elementInfoMessage($message);
        }
        foreach (Registry::getRegistry()->getMessenger()->getWarnMessagesArray() as $message) {
            $ret .= $this->elementWarnMessage($message);
        }
        return $ret;
    }

    public function elementInfoMessage($message)
    {
        return $this->elementMessage($message, "alert-info");
    }

    public function elementErrorMessage($message)
    {
        return $this->elementMessage($message, "alert-danger");
    }

    public function elementWarnMessage($message)
    {
        return $this->elementMessage($message, "alert-warning");
    }


    public function elementMessage($message, $class)
    {
        return
            element::div(
                attribute::clazz("alert alert-dismissible " . $class),
                $message,
                $this->elementMessageDismiss()
            );
    }

    public function elementMessageDismiss() {
        return
        element::button(
            attribute::type('button'),
            attribute::clazz('close'),
            attribute::data_dismiss('alert'),
            element::span(
                attribute::aria_hidden(),
                '&times;'
            )
        );
    }
}
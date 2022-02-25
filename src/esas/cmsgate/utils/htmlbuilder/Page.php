<?php


namespace esas\cmsgate\utils\htmlbuilder;


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
}
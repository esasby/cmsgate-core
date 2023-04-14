<?php


namespace esas\cmsgate\utils\htmlbuilder\hro;


interface HROFactory
{
    /**
     * Must be used for calling non-overridden methods
     * @return $this
     */
    public static function getInstance();

    /**
     * Must be used for calling overridden methods
     * @return $this
     */
    public static function fromRegistry();
}
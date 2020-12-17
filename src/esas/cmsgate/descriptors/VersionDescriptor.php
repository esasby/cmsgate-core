<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 19.05.2020
 * Time: 14:37
 */

namespace esas\cmsgate\descriptors;


class VersionDescriptor
{
    private $version;
    private $date;

    /**
     * VersionDescriptor constructor.
     * @param $version
     * @param $date
     */
    public function __construct($version, $date)
    {
        $this->version = $version;
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    public function __toString()
    {
        return $this->getVersion() . "[" . $this->getDate() . "]";
    }
}
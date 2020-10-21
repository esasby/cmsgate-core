<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 19.05.2020
 * Time: 14:37
 */

namespace esas\cmsgate\descriptors;


class VendorDescriptor
{
    private $machineName;
    private $fullName;
    private $url;

    /**
     * VendorDescriptor constructor.
     * @param $machineName
     * @param $fullName
     * @param $url
     */
    public function __construct($machineName, $fullName, $url)
    {
        $this->machineName = $machineName;
        $this->fullName = $fullName;
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getMachineName()
    {
        return $this->machineName;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    public static function esas() {
        return new VendorDescriptor(
            "esas",
            "Electronic Systems and Services LTD.",
            "http://www.esas.by"
        );
    }
}
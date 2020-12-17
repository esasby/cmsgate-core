<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 18.05.2020
 * Time: 14:59
 */

namespace esas\cmsgate\descriptors;


abstract class AbstractDescriptor
{
    private $moduleMachineName;
    private $moduleFullName;
    private $moduleUrl;
    /**
     * @var VersionDescriptor
     */
    private $version;
    /**
     * @var VendorDescriptor
     */
    private $vendor;

    /**
     * AbstractDescriptor constructor.
     * @param $moduleMachineName
     * @param $moduleVersion
     * @param $moduleFullName
     * @param $moduleUrl
     * @param $vendorMachineName
     * @param $vendorFullName
     * @param $vendorUrl
     */
    public function __construct($moduleMachineName, $moduleVersion, $moduleFullName, $moduleUrl, $vendor)
    {
        $this->moduleMachineName = $moduleMachineName;
        $this->version = $moduleVersion;
        $this->moduleFullName = $moduleFullName;
        $this->moduleUrl = $moduleUrl;
        $this->vendor = $vendor;
    }

    /**
     * @return mixed
     */
    public function getModuleMachineName()
    {
        return $this->moduleMachineName;
    }

    /**
     * @return mixed
     */
    public function getModuleFullName()
    {
        return $this->moduleFullName;
    }

    /**
     * @return mixed
     */
    public function getModuleUrl()
    {
        return $this->moduleUrl;
    }

    /**
     * @return VersionDescriptor
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return VendorDescriptor
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    public function __toString()
    {
        return $this->getModuleMachineName() . ": " . $this->getVersion();
    }
}
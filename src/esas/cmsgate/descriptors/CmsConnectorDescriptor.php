<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 18.05.2020
 * Time: 14:59
 */

namespace esas\cmsgate\descriptors;


class CmsConnectorDescriptor extends AbstractDescriptor
{
    private $defaultModuleType;
    private $cmsMachineName;

    /**
     * CmsConnectorDescriptor constructor.
     * @param $cmsMachineName
     */
    public function __construct($moduleMachineName, $moduleVersion, $moduleFullName, $moduleUrl, $vendor, $cmsMachineName, $defaultModuleType = "")
    {
        parent::__construct($moduleMachineName, $moduleVersion, $moduleFullName, $moduleUrl, $vendor);
        $this->cmsMachineName = $cmsMachineName;
        $this->defaultModuleType = $defaultModuleType;
    }


    /**
     * @return string
     */
    public function getCmsMachineName()
    {
        return $this->cmsMachineName;
    }

    /**
     * @return string
     */
    public function getDefaultModuleType()
    {
        return $this->defaultModuleType;
    }
}
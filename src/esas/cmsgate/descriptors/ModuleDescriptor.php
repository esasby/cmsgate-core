<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 19.05.2020
 * Time: 11:40
 */

namespace esas\cmsgate\descriptors;


class ModuleDescriptor extends AbstractDescriptor
{
    private $moduleDescription;

    /**
     * ModuleDescriptor constructor.
     * @param $moduleDescription
     */
    public function __construct($moduleMachineName, $moduleVersion, $moduleFullName, $moduleUrl, $vendor, $moduleDescription)
    {
        parent::__construct($moduleMachineName, $moduleVersion, $moduleFullName, $moduleUrl, $vendor);
        $this->moduleDescription = $moduleDescription;
    }

    /**
     * @return string
     */
    public function getModuleDescription()
    {
        return $this->moduleDescription;
    }

    
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 19.05.2020
 * Time: 11:40
 */

namespace esas\cmsgate\descriptors;


use esas\cmsgate\Registry;

class ModuleDescriptor extends AbstractDescriptor
{
    private $moduleType;
    private $moduleDescription;

    /**
     * ModuleDescriptor constructor.
     * @param $moduleDescription
     */
    public function __construct($moduleMachineName, $moduleVersion, $moduleFullName, $moduleUrl, $vendor, $moduleDescription, $moduleType = "")
    {
        parent::__construct($moduleMachineName, $moduleVersion, $moduleFullName, $moduleUrl, $vendor);
        $this->moduleDescription = $moduleDescription;
        $this->moduleType = $moduleType;
    }

    /**
     * @return string
     */
    public function getModuleDescription()
    {
        return $this->moduleDescription;
    }

    /**
     * @return string
     */
    public function getModuleType()
    {
        if (!empty($this->moduleType))
            return $this->moduleType;
        else //если не задан для модуля, берем тип для CMS-коннектора
            return Registry::getRegistry()->getCmsConnector()->getCmsConnectorDescriptor()->getDefaultModuleType();
    }

    public function getCmsAndPaysystemName($delimiter = '_') {
        return Registry::getRegistry()->getCmsConnector()->getCmsConnectorDescriptor()->getCmsMachineName()
            . $delimiter
            . Registry::getRegistry()->getPaySystemName();
    }
}
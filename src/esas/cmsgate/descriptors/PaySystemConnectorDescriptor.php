<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 18.05.2020
 * Time: 14:59
 */

namespace esas\cmsgate\descriptors;


class PaySystemConnectorDescriptor extends AbstractDescriptor
{
    private $paySystemMachinaName;

    /**
     * PaySystemConnectorDescriptor constructor.
     * @param $paySystemMachinaName
     */
    public function __construct($moduleMachineName, $moduleVersion, $moduleFullName, $moduleUrl, $vendor, $paySystemMachinaName)
    {
        parent::__construct($moduleMachineName, $moduleVersion, $moduleFullName, $moduleUrl, $vendor);
        $this->paySystemMachinaName = $paySystemMachinaName;
    }


    /**
     * @return mixed
     */
    public function getPaySystemMachinaName()
    {
        return $this->paySystemMachinaName;
    }
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 06.03.2020
 * Time: 10:51
 */

namespace esas\cmsgate\view\admin;

abstract class ConfigPage
{
    /**
     * @var ConfigForm[]
     */
    protected $configFormsArray;

    /**
     * ConfigPage constructor.
     * @param ConfigForm[] $configFormsArray
     */
    public function __construct(array $configFormsArray = null)
    {
        $this->configFormsArray = $configFormsArray;
    }

    /**
     * @param $configForm
     * @return $this
     */
    public function addForm($configForm) {
        $this->configFormsArray[] = $configForm;
        return $this;
    }

    /**
     * @return ConfigForm[]
     */
    public function getConfigFormsArray()
    {
        return $this->configFormsArray;
    }

    public abstract function generate();
}
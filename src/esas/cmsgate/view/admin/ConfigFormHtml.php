<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 30.09.2018
 * Time: 15:15
 */

namespace esas\cmsgate\view\admin;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\view\admin\fields\ConfigFieldCheckbox;
use esas\cmsgate\view\admin\fields\ConfigFieldFile;
use esas\cmsgate\view\admin\fields\ConfigFieldList;
use esas\cmsgate\view\admin\fields\ConfigFieldNumber;
use esas\cmsgate\view\admin\fields\ConfigFieldPassword;
use esas\cmsgate\view\admin\fields\ConfigFieldRichtext;
use esas\cmsgate\view\admin\fields\ConfigFieldStatusList;
use esas\cmsgate\view\admin\fields\ConfigFieldTextarea;

/**
 * Class ConfigurationRender обеспечивает render (в html) полей для редактирования настроек плагина
 * В плагинах для конкретных CMS должен быть создан наследник и переопределены методы render****Field
 * (минимум должен быть переопределен renderTextField).
 * Пример использования для opencart:
 * $configFieldsRender = new ConfigurationRenderOpencart();
 * $configFieldsRender->addAll();
 * $configFieldsRender->addField(new ConfigFieldNumber <> ); // добавление какого-то особоного поля для CMS
 * $configFieldsRender->render(); // формирует html
 * @package esas\cmsgate\view\admin
 */
abstract class ConfigFormHtml extends ConfigForm
{
    /**
     * @var string
     */
    protected $headingTitle;

    /**
     * @var string
     */
    protected $submitUrl;

    /**
     * @var array
     */
    protected $submitButtons;

    /**
     * ConfigFormHtml constructor.
     * @param string $headingTitle
     */
    public function __construct($managedFields, $headingTitle, $submitUrl, $submitButtons)
    {
        parent::__construct($managedFields);
        $this->headingTitle = $headingTitle;
        $this->submitUrl = $submitUrl;
        $this->submitButtons = $submitButtons;
    }

    /**
     * @return string
     */
    public function getHeadingTitle()
    {
        return $this->headingTitle;
    }

    /**
     * @param string $headingTitle
     */
    public function setHeadingTitle($headingTitle)
    {
        $this->headingTitle = $headingTitle;
    }

    /**
     * @return string
     */
    public function getSubmitUrl()
    {
        return $this->submitUrl;
    }

    /**
     * @param string $submitUrl
     */
    public function setSubmitUrl($submitUrl)
    {
        $this->submitUrl = $submitUrl;
    }

    /**
     * @return array
     */
    public function getSubmitButtons()
    {
        return $this->submitButtons;
    }

    /**
     * @param array $submitButtons
     */
    public function setSubmitButtons($submitButtons)
    {
        $this->submitButtons = $submitButtons;
    }


    /**
     * @param $name
     * @param null $value
     * @return $this
     */
    public function addSubmitButton($name, $value = null)
    {
        if ($value != null)
            $this->submitButtons[$name] = $value;
        else
            $this->submitButtons[$name] = Registry::getRegistry()->getTranslator()->translate($name);
        return $this;
    }


    /**
     * Производит формирование конечного html с настройками модуля
     * @return string
     */
    public function generate()
    {
        $ret = "";
        // при проверке instanceof не забывать про наследование
        foreach ($this->managedFields->getFieldsToRender() as $configField) {
            if ($configField instanceof ConfigFieldPassword) {
                $ret .= $this->generatePasswordField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldRichtext) {
                $ret .= $this->generateRichtextField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldTextarea) {
                $ret .= $this->generateTextAreaField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldNumber) {
                $ret .= $this->generateNumberField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldCheckbox) {
                $ret .= $this->generateCheckboxField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldStatusList) {
                $ret .= $this->generateStatusListField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldList) {
                $ret .= $this->generateListField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldFile) {
                $ret .= $this->generateFileField($configField);
                continue;
            } else
                $ret .= $this->generateTextField($configField);
        }
        return $ret;
    }

    protected static function elementOptions(ConfigFieldList $configField)
    {
        $ret = array();
        foreach ($configField->getOptions() as $option) {
            $ret[] = element::option(
                attribute::value($option->getValue()),
                attribute::selected($option->getValue() == $configField->getValue()),
                element::content($option->getName())
            );
        }
        return $ret;
    }
}
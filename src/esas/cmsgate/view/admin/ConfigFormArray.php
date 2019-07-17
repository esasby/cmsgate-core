<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 30.09.2018
 * Time: 15:15
 */

namespace esas\cmsgate\view\admin;


use esas\cmsgate\view\admin\fields\ConfigFieldCheckbox;
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
abstract class ConfigFormArray extends ConfigForm
{

    /**
     * Производит формирование конечного html с настройками модуля
     * @return array
     */
    public function generate()
    {
        // при проверке instanceof не забывать про наследование
        foreach ($this->managedFields->getFieldsToRender() as $configField) {
            if ($configField instanceof ConfigFieldPassword) {
                $ret[$configField->getKey()] = $this->generatePasswordField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldRichtext) {
                $ret[$configField->getKey()] = $this->generateRichtextField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldTextarea) {
                $ret[$configField->getKey()] = $this->generateTextAreaField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldNumber) {
                $ret[$configField->getKey()] = $this->generateNumberField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldCheckbox) {
                $ret[$configField->getKey()] = $this->generateCheckboxField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldStatusList) {
                $ret[$configField->getKey()] = $this->generateStatusListField($configField);
                continue;
            } elseif ($configField instanceof ConfigFieldList) {
                $ret[$configField->getKey()] = $this->generateListField($configField);
                continue;
            } else
                $ret[$configField->getKey()] = $this->generateTextField($configField);
        }
        return $ret;
    }
}
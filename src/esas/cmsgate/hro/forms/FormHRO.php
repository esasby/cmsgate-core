<?php


namespace esas\cmsgate\hro\forms;


use esas\cmsgate\hro\HRO;
use esas\cmsgate\view\admin\fields\ConfigField;

/**
 * @package esas\cmsgate\hro\forms
 */
interface FormHRO extends HRO
{

    /**
     * @param $id
     * @return FormHRO
     */
    public function setId($id);

    /**
     * @param $action
     * @return FormHRO
     */
    public function setAction($action);

    /**
     * @param $managedFields
     * @return FormHRO
     */
    public function setManagedFields($managedFields);

    /**
     * @param $field ConfigField
     * @return FormHRO
     */
    public function addManagedField($field);

    /**
     * @param $key
     * @param $value
     * @return FormHRO
     */
    public function addHiddenInput($key, $value);

    /**
     * @param $name
     * @param null $value
     * @return $this
     */
    public function addButtonSubmit($name, $value = null);

    /**
     * @return FormHRO
     */
    public function addButtonSave();

    /**
     * @param $label
     * @param $href
     * @param string $classAppend
     * @return FormHRO
     */
    public function addButton($label, $href, $classAppend = '');

    /**
     * @param $redirectHref
     * @return FormHRO
     */
    public function addButtonDelete($redirectHref);

    /**
     * @param $redirectHref
     * @return FormHRO
     */
    public function addButtonCancel($redirectHref);
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 07.03.2020
 * Time: 13:18
 */

namespace esas\cmsgate\utils;


use esas\cmsgate\view\admin\ConfigForm;

class SessionUtils
{

    const SESSION_FROMS_ARRAY = "cmsgate_forms";

    /**
     * @param ConfigForm $configForm
     */
    public static function storeForm($configForm)
    {
        $_SESSION[self::SESSION_FROMS_ARRAY][$configForm->getFormKey()] = serialize($configForm);
    }

    /**
     * @param $formKey
     * @return
     */
    public static function getForm($formKey)
    {
        $obj = $_SESSION[self::SESSION_FROMS_ARRAY][$formKey];
        if ($obj == null)
            return null;
        else
            return unserialize($obj);
    }

    /**
     * @param ConfigForm $configForm
     */
    public static function removeForm($configForm)
    {
        unset($_SESSION[self::SESSION_FROMS_ARRAY][$configForm->getFormKey()]);
    }

    public static function removeAllFroms()
    {
        unset($_SESSION[self::SESSION_FROMS_ARRAY]);
    }
}
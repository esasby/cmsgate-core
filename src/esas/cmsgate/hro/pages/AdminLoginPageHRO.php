<?php


namespace esas\cmsgate\hro\pages;


use esas\cmsgate\hro\HRO;
use esas\cmsgate\utils\htmlbuilder\page\AbstractPage;

interface AdminLoginPageHRO extends HRO, AbstractPage
{
    /**
     * @param mixed $loginFormAction
     * @return AdminLoginPageHRO
     */
    public function setLoginFormAction($loginFormAction);

    /**
     * @param mixed $logoUrl
     * @return AdminLoginPageHRO
     */
    public function setLogo($logoUrl);

    /**
     * @param mixed $message
     * @return AdminLoginPageHRO
     */
    public function setMessage($message);

    /**
     * @param $fieldId
     * @param $fieldLabel
     * @return AdminLoginPageHRO
     */
    public function setLoginField($fieldId, $fieldLabel);

    /**
     * @param $fieldId
     * @param $fieldLabel
     * @return AdminLoginPageHRO
     */
    public function setPasswordField($fieldId, $fieldLabel);

    /**
     * @param bool $sandbox
     * @return AdminLoginPageHRO
     */
    public function setSandbox($sandbox);
}
<?php


namespace esas\cmsgate\hro\pages;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\CssPreset as css;
use esas\cmsgate\utils\htmlbuilder\presets\ScriptsPreset as script;

class AdminLoginPageHRO_v1 extends PageHRO implements AdminLoginPageHRO
{
    protected $loginFormAction;
    protected $logoUrl;
    protected $message;
    protected $loginFieldId = 'login'; //default
    protected $loginFieldLabel = "Login";
    protected $passwordFieldId = "password"; //default
    protected $passwordFieldLabel = 'password';
    protected $sandbox = false;

    /**
     * @inheritDoc
     */
    public function setLoginFormAction($loginFormAction) {
        $this->loginFormAction = $loginFormAction;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLogo($logoUrl) {
        $this->logoUrl = $logoUrl;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLoginField($fieldId, $fieldLabel) {
        $this->loginFieldId = $fieldId;
        $this->loginFieldLabel = $fieldLabel;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPasswordField($fieldId, $fieldLabel) {
        $this->passwordFieldId = $fieldId;
        $this->passwordFieldLabel = $fieldLabel;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setSandbox($sandbox) {
        $this->sandbox = $sandbox;
        return $this;
    }

    public static function builder() {
        return new AdminLoginPageHRO_v1();
    }

    public function elementPageHead()
    {
        return element::head(
            element::title(
                element::content($this->getPageTitle())
            ),
            $this->elementHeadMetaCharset('utf-8'),
            element::meta(
                attribute::name('viewport'),
                attribute::content('width=device-width, shrink-to-fit=no, initial-scale=1')),
            css::elementLinkCssGoogleFonts("css?family=Merienda+One"),
            css::elementLinkCssGoogleFonts("icon?family=Material+Icons"),
            css::elementLinkCssFontAwesome4Min(),
            css::elementLinkCssBootstrap4Min(),
            script::elementScriptJquery3Min(),
            script::elementScriptBootstrap4Min(),
            script::elementScriptPopper1Min(),
            element::styleFile(dirname(__FILE__) . "/login.css")
        );
    }

    public function getPageTitle()
    {
        return "Login";
    }

    public function elementPageBody()
    {
        return element::body(
            element::div(
                attribute::clazz("login-form"),
                element::form(
                    $this->attributeLoginFormAction(),
                    attribute::method("post"),
                    element::div(
                        attribute::clazz("avatar"),
                        element::i(
                            attribute::clazz("material-icons"),
                            "&#xE7FF;"
                        )
                    ),
                    element::h4(
                        attribute::clazz("modal-title"),
                        (!empty($this->message) ? $this->message : $this->defautMessage()) . $this->elementTestLabel()
                    ),
                    $this->elementLoginInput(),
                    $this->elementPasswordInput(),
                    $this->elementMessages(),
                    $this->elementSubmitButton()
                )
            )
        );
    }

    public function defautMessage() {
        return "Login to " . Registry::getRegistry()->getPaysystemConnector()->getPaySystemConnectorDescriptor()->getPaySystemMachinaName();
    }

    public function elementTestLabel()
    {
        return $this->sandbox ?
            element::small(
                attribute::style('color: #EC9941!important; vertical-align: sub'),
                element::content('test')) : "";
    }

    public function attributeLoginFormAction()
    {
        return $this->loginFormAction != null ? attribute::action($this->loginFormAction) : "";
    }

    public function elementLoginInput()
    {
        return
            element::div(
                attribute::clazz("form-group"),
                element::input(
                    attribute::id($this->loginFieldId),
                    attribute::name($this->loginFieldId),
                    attribute::clazz("form-control"),
                    attribute::type("text"),
                    attribute::placeholder($this->loginFieldLabel),
                    attribute::required()
                )
            );
    }
    public function elementPasswordInput()
    {
        return
            element::div(
                attribute::clazz("form-group"),
                element::input(
                    attribute::id($this->passwordFieldId),
                    attribute::name($this->passwordFieldId),
                    attribute::clazz("form-control"),
                    attribute::type("password"),
                    attribute::placeholder($this->passwordFieldLabel),
                    attribute::required()
                )
            );
    }

    public function elementSubmitButton()
    {
        return
            element::input(
                attribute::type("submit"),
                attribute::clazz("btn btn-primary btn-block btn-lg"),
                attribute::value("Login")
            );
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 10.10.2018
 * Time: 11:27
 */

namespace esas\cmsgate\view\client;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\Registry;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\utils\QRUtils;
use esas\cmsgate\wrappers\ConfigurationWrapper;
use esas\cmsgate\wrappers\OrderWrapper;
use Throwable;

class Panel
{
    /**
     * @var ConfigurationWrapper
     */
    private $configurationWrapper;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var OrderWrapper
     */
    private $orderWrapper;

    /**
     * @var ViewStyle
     */
    private $viewStyle;

    /**
     * ViewData constructor.
     * @param OrderWrapper $orderWrapper
     */
    public function __construct(OrderWrapper $orderWrapper)
    {
        $this->configurationWrapper = Registry::getRegistry()->getConfigurationWrapper();
        $this->translator = Registry::getRegistry()->getTranslator();
        $this->orderWrapper = $orderWrapper;
        $this->viewStyle = new ViewStyle();
    }

    /**
     * @return ViewStyle
     */
    public function getViewStyle()
    {
        return $this->viewStyle;
    }

    public function render() {
        $viewData = $this;
        $viewStyle = $this->viewStyle;
        try {
            include(dirname(__FILE__) . "/completionAccordion.php");
        } catch (Throwable $e) {
            Logger::getLogger("Panel")->error("Exception:", $e);
        }
    }
}
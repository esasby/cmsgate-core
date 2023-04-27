<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 24.06.2019
 * Time: 14:11
 */

namespace esas\cmsgate\hro\pages;

use esas\cmsgate\hro\HRO;
use esas\cmsgate\utils\htmlbuilder\page\AdditionalCssPage;
use esas\cmsgate\wrappers\OrderWrapper;

interface ClientOrderCompletionPageHRO extends HRO, AdditionalCssPage
{
    /**
     * @param $orderWrapper OrderWrapper
     * @return ClientOrderCompletionPageHRO
     */
    public function setOrderWrapper($orderWrapper);

    /**
     * @param $elementCompletionPanel
     * @return ClientOrderCompletionPageHRO
     */
    public function setElementCompletionPanel($elementCompletionPanel);
}
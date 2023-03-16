<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\cards;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\hro\HRO;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;
use esas\cmsgate\view\admin\AdminViewFields;

interface CardFooterHRO extends HRO
{
    /**
     * @param $label
     * @param $href
     * @param $classAppend
     * @param bool $translateLabel
     * @return $this
     */
    public function addButton($label, $href, $classAppend, $translateLabel = true);

    /**
     * @param $redirectHref
     * @return $this
     */
    public function addButtonCancel($redirectHref);

    /**
     * @param $redirectHref
     * @return $this
     */
    public function addButtonDelete($redirectHref);

    public function addButtonSubmit($name, $value = null);
}
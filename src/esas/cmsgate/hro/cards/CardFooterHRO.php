<?php


namespace esas\cmsgate\hro\cards;


use esas\cmsgate\hro\HRO;

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
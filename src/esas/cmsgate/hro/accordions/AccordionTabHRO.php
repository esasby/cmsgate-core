<?php


namespace esas\cmsgate\hro\accordions;


use esas\cmsgate\hro\HRO;

interface AccordionTabHRO extends HRO
{
    /**
     * @param mixed $key
     * @return AccordionTabHRO
     */
    public function setKey($key);

    /**
     * @param mixed $header
     * @return AccordionTabHRO
     */
    public function setHeader($header);

    /**
     * @param mixed $body
     * @return AccordionTabHRO
     */
    public function setBody($body);

    /**
     * @param bool $checked
     * @return AccordionTabHRO
     */
    public function setChecked($checked);

    /**
     * @param mixed $parentId
     * @param bool $forceOverride
     * @return AccordionTabHRO
     */
    public function setParentId($parentId, $forceOverride = false);

    /**
     * @param bool $onlyOneTabEnabled
     * @return AccordionTabHRO
     */
    public function setOnlyOneTabEnabled($onlyOneTabEnabled);
}
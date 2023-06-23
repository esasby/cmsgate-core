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
     * @return AccordionTabHRO
     */
    public function setParentId($parentId);

    /**
     * @return mixed
     */
    public function getParentId();
}
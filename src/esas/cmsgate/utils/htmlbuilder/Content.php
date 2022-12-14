<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 05.03.2019
 * Time: 14:42
 */

namespace esas\cmsgate\utils\htmlbuilder;


use esas\cmsgate\utils\ArrayUtils;

/**
 * Class Content используется для представления контента html элемента (т.е. только содержимого без тегов)
 * @package esas\cmsgate\utils\htmlbuilder
 */
class Content
{
    private $contentObjects;

    /**
     * Content constructor.
     * @param $contentObjects
     */
    public function __construct(array $contentObjects)
    {
        $this->contentObjects = ArrayUtils::flatten($contentObjects);
    }

    public function __toString()
    {
        return ArrayUtils::safeImplode(" ", $this->contentObjects);
    }
}
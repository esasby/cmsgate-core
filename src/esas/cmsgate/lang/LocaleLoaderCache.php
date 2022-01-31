<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 27.09.2018
 * Time: 13:09
 */

namespace esas\cmsgate\lang;

use esas\cmsgate\cache\Cache;

abstract class LocaleLoaderCache extends LocaleLoaderCms
{
    /**
     * @var Cache
     */
    protected $orderCache;

    public function __construct($orderCache)
    {
        $this->orderCache = $orderCache;
    }
}
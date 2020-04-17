<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 17.01.2020
 * Time: 15:11
 */

namespace esas\cmsgate\utils;

use Exception;

class UploadedFileWrapper extends FileWrapper
{
        /**
     * FileWrapper constructor.
     * @param $name
     * @throws Exception
     */
    public function __construct($name)
    {
        $dir = dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/upload/';
        FileUtils::createSafeDir($dir);
        parent::__construct($dir . $name);
    }

}
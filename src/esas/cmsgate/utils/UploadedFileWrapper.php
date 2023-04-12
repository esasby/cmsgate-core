<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 17.01.2020
 * Time: 15:11
 */

namespace esas\cmsgate\utils;

class UploadedFileWrapper extends FileWrapper
{
    /**
     * FileWrapper constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $dir = dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/upload/';
        parent::__construct($dir . $name);
    }

}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 07.12.2018
 * Time: 11:55
 */

namespace esas\cmsgate\view\admin\validators;


use esas\cmsgate\utils\FileUtils;

class ValidatorUploadFileSize extends ValidatorUploadFile
{
    private $sizeInBytesMin;
    private $sizeInBytesMax;

    /**
     * ValidatorNumber constructor.
     */
    public function __construct($sizeInBytesMin, $sizeInBytesMax)
    {
        parent::__construct([$sizeInBytesMin, $sizeInBytesMax]);
        $this->sizeInBytesMin = $sizeInBytesMin;
        $this->sizeInBytesMax = $sizeInBytesMax;
    }

    /**
     * @return boolean
     */
    public function validateValue($fileMetaData)
    {
        if (FileUtils::isPresentForUpload($fileMetaData) && $this->sizeInBytesMin != null && strrchr($fileMetaData['name'], '.') != $this->sizeInBytesMin)
            return false;
        return true;
    }
}
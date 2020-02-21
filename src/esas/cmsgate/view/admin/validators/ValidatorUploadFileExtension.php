<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 07.12.2018
 * Time: 11:55
 */

namespace esas\cmsgate\view\admin\validators;


use esas\cmsgate\utils\FileUtils;

class ValidatorUploadFileExtension extends ValidatorUploadFile
{
    private $extension;

    /**
     * ValidatorNumber constructor.
     */
    public function __construct($sizeInBytesMin)
    {
        parent::__construct([$sizeInBytesMin]);
        $this->extension = $sizeInBytesMin;
    }

    /**
     * @return boolean
     */
    public function validateValue($fileMetaData)
    {
        if (FileUtils::isPresentForUpload($fileMetaData) && $this->extension != null && strrchr($fileMetaData['name'], '.') != $this->extension)
            return false;
        return true;
    }
}
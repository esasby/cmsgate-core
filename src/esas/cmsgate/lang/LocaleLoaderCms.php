<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 16.07.2019
 * Time: 12:25
 */

namespace esas\cmsgate\lang;


abstract class LocaleLoaderCms
{
    /**
     * Locale по умолчанию, может быть переопределен
     * @return string
     */
    public function getLocale()
    {
        return Locale::ru_RU;
    }
    
    public abstract function getCmsVocabularyDir();
}
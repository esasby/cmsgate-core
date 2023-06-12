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
     * @var array
     */
    private $extraVocabularyDirs;

    /**
     * Locale по умолчанию, может быть переопределен
     * @return string
     */
    public function getLocale()
    {
        return Locale::ru_RU;
    }

    public function addExtraVocabularyDir($extraVocabularyDir) {
        $this->extraVocabularyDirs[] = $extraVocabularyDir;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraVocabularyDirs()
    {
        // для совместимости с deprecated методом
        $cmsVocabularyDir = $this->getCmsVocabularyDir();
        if ($cmsVocabularyDir != null && $cmsVocabularyDir !== null)
            $this->extraVocabularyDirs[] = $cmsVocabularyDir;
        return $this->extraVocabularyDirs;
    }

    /**
     * @deprecated use addExtraVocabularyDir instead
     * @return mixed
     */
    public function getCmsVocabularyDir() {
        return '';
    }
}
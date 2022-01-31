<?php

namespace esas\cmsgate\lang;

use esas\cmsgate\Registry;

/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 09.07.2018
 * Time: 11:51
 */
class TranslatorImpl extends Translator
{
    private $lang;

    /**
     * @var LocaleLoaderCms
     */
    private $localeLoader;

    /**
     * @var array
     */
    private $extraVocabularyDirs;

    /**
     * TranslatorImpl constructor.
     * @param LocaleLoaderCms $localeLoader
     * @param $psMsgDir - путь к дополнительным словарям
     */
    public function __construct($paySystemVocabularyDir)
    {
        parent::__construct();
        $this->localeLoader = Registry::getRegistry()->createLocaleLoader();
        $this->extraVocabularyDirs = $this->localeLoader->getExtraVocabularyDirs();
        $this->extraVocabularyDirs[] = $paySystemVocabularyDir;
    }

    private function loadLocale($locale)
    {
        if (!isset($this->lang) || null == $this->lang[$locale]) {
            $this->loadLocaleFromDir(__DIR__, $locale); //загружаем локаль из каталога lang core
            foreach ($this->extraVocabularyDirs as $extraVocabularyDir) {
                $this->loadLocaleFromDir($extraVocabularyDir, $locale); //загружаем локаль для каталога lang наследника
            }
        }
    }

    private function loadLocaleFromDir($dir, $locale) {
        $file = $dir . "/" . $locale . ".php";
        if (!file_exists($file)) {
            $code = substr($locale, 0, 2);
            $file = $dir . "/" . $code . "_" . strtoupper($code) . ".php";
            if (!file_exists($file))
                $file = $dir . "/ru_RU.php";
        }
        if (!file_exists($file) || is_dir($file)) {//пропускаем
            $this->logger->debug("Translation file was not found: " . $file);
            return;
        }
        $vocabulary = include $file;
        if (isset($this->lang) && is_array($this->lang[$locale]))
            $this->lang[$locale] = array_merge($this->lang[$locale], $vocabulary);
        else
            $this->lang[$locale] = $vocabulary;
    }


    /**
     * Translator constructor.
     */
    public function translate($msg, $locale = null)
    {
        if (null == $locale)
            $locale = $this->localeLoader->getLocale();
        $this->loadLocale($locale);
        if (array_key_exists($msg, $this->lang[$locale]))
            return $this->lang[$locale][$msg];
        else
            return $msg;
    }


}
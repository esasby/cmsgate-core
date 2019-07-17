<?php

namespace esas\cmsgate\lang;

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
     * @var string
     */
    private $psMsgDir;

    /**
     * TranslatorImpl constructor.
     * @param LocaleLoaderCms $localeLoader
     */
    public function __construct(LocaleLoaderCms $localeLoader, $psMsgDir)
    {
        $this->localeLoader = $localeLoader;
        $this->psMsgDir = $psMsgDir;

    }

    private function loadLocale($locale)
    {
        if (null == $this->lang[$locale]) {
            $this->loadLocaleFromDir(__DIR__, $locale); //загружаем локаль из каталога lang core
            $this->loadLocaleFromDir($this->psMsgDir, $locale); //загружаем локаль для каталога lang наследника
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
        $this->lang[$locale] = include $file;
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
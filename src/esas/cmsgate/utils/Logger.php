<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 16.08.2018
 * Time: 7:35
 */

namespace esas\cmsgate\utils;


use esas\cmsgate\Registry;
use Exception;
use Logger as Log4php;
use LoggerAppenderFile;
use LoggerLayoutPattern;
use Throwable;

class Logger
{
    private $logger;

    /**
     * LoggerDefault constructor.
     * @param $logger
     */
    public function __construct($name)
    {
        $this->logger = Log4php::getLogger($name);
        //удялем все appender-ы, т.к. если делать конфигурацию через статическую конфигурацию, то логи могут писаться
        //в файл, который был сконифигурирован в другом плагине (видимо из-за статичности)
        $this->logger->removeAllAppenders();
        $this->logger->setAdditivity(false);
        $layout = new LoggerLayoutPattern();
        $layout->setConversionPattern("%date{Y-m-d H:i:s,u} | %logger{0} | %-5level | %msg %n");
        $layout->activateOptions();
        $appFile = new LoggerAppenderFile('cmsFileAppender');
        $appFile->setFile(self::getLogFilePath());
        $appFile->setAppend(true);
        /**
         * Тут не получается установить порог в зависимости от значения
         * Registry::getRegistry()->getConfigWrapper()->isDebugMode(), т.к. при таком вызове возникает бесконечная рекурсия
         * Проверка порога вынесена в методы trace и debug
         */
        $appFile->setThreshold('ALL');
        $appFile->activateOptions();
        $appFile->setLayout($layout);
        $this->logger->addAppender($appFile);
    }


    public static function init()
    {
        FileUtils::createSafeDir(self::getLogFileDirectory());
    }

    public static function getLogFileDirectory()
    {
        return dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/logs';
    }

    public static function getLogFilePath()
    {
        return self::getLogFileDirectory() . '/cmsgate.log';
    }

    public static function getLogger($name)
    {
        return new Logger($name);
    }

    public function error($message, $throwable = null)
    {
        $this->logger->error($message . self::getStackTrace($throwable));
    }

    public function warn($message, $throwable = null)
    {
        $this->logger->warn($message . self::getStackTrace($throwable));
    }

    public function info($message, $throwable = null)
    {
        $this->logger->info($message . self::getStackTrace($throwable));
    }

    public function debug($message, $throwable = null)
    {
        if (!Registry::getRegistry()->getConfigWrapper()->isDebugMode())
            return;
        $this->logger->debug($message . self::getStackTrace($throwable));
    }

    public function fatal($message, $throwable = null)
    {
        $this->logger->fatal($message . self::getStackTrace($throwable));
    }

    public function trace($message, $throwable = null)
    {
        if (!Registry::getRegistry()->getConfigWrapper()->isDebugMode())
            return;
        $this->logger->trace($message . self::getStackTrace($throwable));
    }

    /**
     * В библиотеке log4php v 2.3.0 есть баг с вывводом trace, при работе с php 7
     */
    public static function getStackTrace($th = null)
    {
        if ($th != null && $th instanceof Throwable || $th instanceof Exception)
            return "\n#E " . $th->getFile() . "(" . $th->getLine() . "): " . $th->getMessage() . "\n" . $th->getTraceAsString();
        else if (is_array($th)) { // backtrace
            $ret = '';
            foreach ($th as $key => $traceElementArray) {
                $ret .= "\n\t#" . $key . " " . $traceElementArray["file"] . "(" .  $traceElementArray["line"] . "): " . $traceElementArray["function"];
            }
            return $ret;
        } else
            return '';
    }
}
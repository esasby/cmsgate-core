<?php

namespace esas\cmsgate\protocol;

use esas\cmsgate\Registry;
use esas\cmsgate\wrappers\ConfigWrapper;
use Exception;
use esas\cmsgate\utils\Logger;
use Throwable;

abstract class Protocol
{
    private $connectionUrl; // url api
    private $ch; // curl object

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var ConfigWrapper
     */
    private $configurationWrapper;

    /**
     * @throws Exception
     */
    public function __construct($realUrl, $testUrl)
    {
        $this->logger = Logger::getLogger(get_class($this));
        $this->configurationWrapper = Registry::getRegistry()->getConfigWrapper();
        if ($this->configurationWrapper->isSandbox()) {
            $this->connectionUrl = $testUrl;
            $this->logger->info("Test mode is on");
        } else {
            $this->connectionUrl = $realUrl;
        }
    }


    /**
     * Подключение GET
     *
     * @param string $path
     * @param string $data
     * @param int $rsType
     * @internal param RsType $rqType
     *
     * @return mixed
     * @throws Exception
     */
    protected function requestGet($path, $data = '', $rsType = RsType::_ARRAY)
    {
        return $this->connect($path, $data, RqMethod::_GET, $rsType);
    }

    /**
     * Подключение POST
     *
     * @param string $path
     * @param string $data
     * @param int $rsType
     * @internal param RsType $rqType
     * @return bool
     * @throws Exception
     */
    protected function requestPost($path, $data = '', $rsType = RsType::_ARRAY)
    {
        return $this->connect($path, $data, RqMethod::_POST, $rsType);
    }

    /**
     * Подключение DELETE
     *
     * @param string $path
     * @param string $data
     * @param int $rsType
     * @internal param RsType $rqType
     *
     * @return mixed
     * @throws Exception
     */
    protected function requestDelete($path, $data = '', $rsType = RsType::_ARRAY)
    {
        return $this->connect($path, $data, RqMethod::_DELETE, $rsType);
    }

    /**
     * Подключение GET, POST или DELETE
     *
     * @param string $path
     * @param string $data Сформированный для отправки XML
     * @param string $request
     * @param $rsType
     *
     * @return mixed
     * @throws Exception
     */
    protected function connect($path, $data = '', $request = RqMethod::_GET, $rsType = RsType::_ARRAY)
    {
        $headers = array('Content-Type: application/xml', 'Content-Length: ' . strlen($data));

        $cookies_path = $this->cookies_dir . DIRECTORY_SEPARATOR . self::$cookies_file;
        // если файла еще нет, то создадим его при залогинивании и будем затем использовать при дальнейших запросах
        if (!is_file($cookies_path) && !is_writable($this->cookies_dir)) {
            throw new Exception('Cookie file[' . $cookies_path . '] is not writable! Check permissions for directory[' . $this->cookies_dir . ']');
        }

        try {
            $this->ch = curl_init();
            $url = $this->connectionUrl . $path;
            curl_setopt($this->ch, CURLOPT_COOKIEJAR, $cookies_path);
            curl_setopt($this->ch, CURLOPT_COOKIEFILE, $cookies_path);
            curl_setopt($this->ch, CURLOPT_URL, $url);
            curl_setopt($this->ch, CURLOPT_HEADER, false); // включение заголовков в выводе
            curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($this->ch, CURLOPT_VERBOSE, true); // вывод доп. информации в STDERR
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false); // не проверять сертификат узла сети
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false); // проверка существования общего имени в сертификате SSL
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true); // возврат результата вместо вывода на экран
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers); // Массив устанавливаемых HTTP-заголовков
            if ($request == 'POST') {
                curl_setopt($this->ch, CURLOPT_POST, true);
                curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
            }
            if ($request == 'DELETE') {
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            }
            // для безопасности прячем пароли из лога
            $this->logger->info('Sending ' . $request . ' request[' . preg_replace('/(<pwd>).*(<\/pwd>)/', '$1********$2', $data) . "] to url[" . $url . "]");
            $response = curl_exec($this->ch);
            $this->logger->info('Got response[' . $response . "]");
            if (curl_errno($this->ch)) {
                throw new Exception(curl_error($this->ch), curl_errno($this->ch));
            }
        } finally {
            curl_close($this->ch);
        }
        switch ($rsType) {
            case RsType::_STRING:
                return $response;
            case RsType::_XML:
                return simplexml_load_string($response);
            case RsType::_ARRAY:
                return $this->responseToArray($response);
            case RsType::_JSON:
                return array_change_key_case(json_decode($response, true), CASE_LOWER);
            default:
                throw new Exception("Wrong rsType.");
        }

    }

    /**
     * Преобразуем XML в массив
     *
     * @return mixed
     */
    private function responseToArray($response)
    {
        $response = trim($response);
        $array = array();
        // проверим, что это xml
        if (preg_match('/^<(.*)>$/', $response)) {
            $xml = simplexml_load_string($response);
            $array = json_decode(json_encode($xml), true);
        }
        return $array;
    }
}

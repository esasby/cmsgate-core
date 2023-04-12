<?php

namespace esas\cmsgate\protocol;

use esas\cmsgate\Registry;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\wrappers\ConfigWrapper;
use Exception;

abstract class ProtocolCurl
{
    protected $connectionUrl; // url api
    protected $ch; // curl object
    /**
     * @var array
     */
    protected $rsHeaders;


    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var ConfigWrapper
     */
    protected $configurationWrapper;

    /**
     * @throws Exception
     */
    public function __construct($realUrl, $testUrl, $configWrapper = null)
    {
        $this->logger = Logger::getLogger(get_class($this));
        if ($configWrapper == null)
            $this->configurationWrapper = Registry::getRegistry()->getConfigWrapper();
        else
            $this->configurationWrapper = $configWrapper;
        if ($this->configurationWrapper->isSandbox()) {
            $this->connectionUrl = $testUrl;
            $this->logger->info("Test mode is on");
        } else {
            $this->connectionUrl = $realUrl;
        }
    }


    /**
     * Отправка GET
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
        return $this->send($path, $data, RqMethod::_GET, $rsType);
    }

    /**
     * Отправка POST
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
        return $this->send($path, $data, RqMethod::_POST, $rsType);
    }

    /**
     * Отправка PUT
     *
     * @param string $path
     * @param string $data
     * @param int $rsType
     * @internal param RsType $rqType
     * @return bool
     * @throws Exception
     */
    protected function requestPut($path, $data = '', $rsType = RsType::_ARRAY)
    {
        return $this->send($path, $data, RqMethod::_PUT, $rsType);
    }

    /**
     * Отправка DELETE
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
        return $this->send($path, $data, RqMethod::_DELETE, $rsType);
    }

    protected function defaultCurlInit($url) {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true); // возврат результата вместо вывода на экран
        if ($this->configurationWrapper->isDebugMode()) {
            $this->rsHeaders = array(); 
            curl_setopt($this->ch, CURLOPT_HEADERFUNCTION, array(&$this, 'collectRsHeaders'));
            curl_setopt($this->ch, CURLOPT_VERBOSE, true); // вывод доп. информации в STDERR
            curl_setopt($this->ch, CURLINFO_HEADER_OUT, true); // вывод отправленных заголовков
        }
    }

    protected function collectRsHeaders($curl, $header_line ) {
        $this->rsHeaders[] = trim($header_line);
        return strlen($header_line);
    }

    protected function execCurlAndLog() {
        $response = curl_exec($this->ch);
        if ($this->configurationWrapper->isDebugMode()) {
            $this->logger->info("Request headers[" . curl_getinfo($this->ch, CURLINFO_HEADER_OUT) . ']');
        }
        $this->logger->info('Got response: code[' . curl_getinfo($this->ch, CURLINFO_RESPONSE_CODE  ) . '] body[' . $response . "]");
        if ($this->configurationWrapper->isDebugMode()) {
            $this->logger->info("Response headers[" . implode("\n", $this->rsHeaders) . ']');
        }
        if (curl_errno($this->ch)) {
            throw new Exception(curl_error($this->ch), curl_errno($this->ch));
        }
        return $response;
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
    protected abstract function send($path, $data, $request, $rsType);

    /**
     * @param $response
     * @param $rsType
     * @return array|mixed|\SimpleXMLElement
     * @throws Exception
     */
    protected function convertRs($response, $rsType) {
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
    protected function responseToArray($response)
    {
        $response = trim($response);
        $array = array();
        // проверим, что это xml
        if (preg_match('/^<(.*)>$/', $response)) {
            $xml = simplexml_load_string($response);
            $array = json_decode(json_encode($xml), true);
        } elseif (preg_match('/^\{(.*)\}$/', $response) || preg_match('/^\[\{(.*)\}\]$/', $response)) { //json
            $array = json_decode($response, true);
        } else
            $this->logger->error('Can not convert response to array');
        return $array;
    }
}

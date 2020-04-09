<?php

namespace esas\cmsgate\protocol;

use esas\cmsgate\Registry;
use esas\cmsgate\wrappers\ConfigWrapper;
use Exception;
use esas\cmsgate\utils\Logger;
use Throwable;

abstract class ProtocolCurl
{
    protected $connectionUrl; // url api
    protected $ch; // curl object
    
    

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
        return $this->send($path, $data, RqMethod::_GET, $rsType);
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
        return $this->send($path, $data, RqMethod::_POST, $rsType);
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
        return $this->send($path, $data, RqMethod::_DELETE, $rsType);
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

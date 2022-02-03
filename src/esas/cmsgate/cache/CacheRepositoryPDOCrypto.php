<?php


namespace esas\cmsgate\cache;


use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

class CacheRepositoryPDOCrypto extends CacheRepositoryPDO
{
    private $key;


    public function __construct($dsn, $user, $pass, $tableName)
    {
        parent::__construct($dsn, $user, $pass, $tableName);
        if (file_exists($this->keyFileName())) {
            $keyStr = file_get_contents($this->keyFileName());
            $this->key = Key::loadFromAsciiSafeString($keyStr);
        } else {
            $this->key = Key::createNewRandomKey();
            file_put_contents($this->keyFileName(), $this->key->saveToAsciiSafeString());
        }
    }

    private function keyFileName() {
        return (dirname(__FILE__)) . '/key.bin';
    }


    public function convertToDB($orderData)
    {
        return Crypto::encrypt($orderData, $this->key);
    }

    public function convertFomDB($orderData)
    {
        return Crypto::decrypt($orderData, $this->key);
    }


}
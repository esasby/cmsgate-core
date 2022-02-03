<?php


namespace esas\cmsgate\cache;


use Defuse\Crypto\Crypto;

class CacheRepositoryPDOCrypto extends CacheRepositoryPDO
{
    private $cryptPassword;

    public function __construct($dsn, $user, $pass, $tableName, $cryptPassword)
    {
        parent::__construct($dsn, $user, $pass, $tableName);
        $this->cryptPassword = $cryptPassword;
    }


    public function convertToDB($orderData)
    {
        return Crypto::encrypt($orderData, $this->cryptPassword);
    }

    public function convertFomDB($orderData)
    {
        return Crypto::decrypt($orderData, $this->cryptPassword);
    }


}
<?php

namespace esas\cmsgate\cache;

use esas\cmsgate\utils\StringUtils;
use PDO;

class CacheRepositoryPDO extends CacheRepository
{
    /**
     * @var PDO
     */
    protected $pdo;

    public function __construct($dsn, $user, $pass)
    {
        parent::__construct();
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $opt);
    }

    /**
     * @param $orderData Cache
     */
    public function add($orderData)
    {
        $uuid = StringUtils::guidv4();
        $orderData = json_encode($orderData);
        $sql = "INSERT INTO cache (id, created_at, order_data, order_data_hash, status) VALUES (:uuid, CURRENT_TIMESTAMP,  :order_data, :order_data_hash, 'new')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'uuid' => $uuid,
            'order_data' => $orderData,
            'order_data_hash' => self::hashData($orderData),
        ]);
        return $uuid;
    }

    private static function hashData($data) {
        return hash('md5', $data);
    }

    public function getByUUID($cacheUUID)
    {
        $sql = "select id, order_data, ext_id, status from cache where id = :uuid";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'uuid' => $cacheUUID,
        ]);
        $cache = null;
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            $cache = new Cache($row['id'], json_decode($row['order_data'], true), $row['ext_id'], $row['status']);
        }
        return $cache;
    }

    public function saveExtId($cacheUUID, $extId)
    {
        $sql = "update cache set ext_id = :ext_id where id = :uuid";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'uuid' => $cacheUUID,
            'ext_id' => $extId,
        ]);
    }

    public function getByExtId($extId)
    {
        $sql = "select id, order_data, ext_id, status from cache where ext_id = :extid";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'extid' => $extId,
        ]);
        $cache = null;
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            $cache = new Cache($row['id'], json_decode($row['order_data'], true), $row['ext_id'], $row['status']);
        }
        return $cache;
    }

    public function getByData($orderData)
    {
        $orderData = json_encode($orderData);
        $sql = "select id, order_data, ext_id, status from cache where order_data_hash = :order_data_hash";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'order_data_hash' => self::hashData($orderData),
        ]);
        $cache = null;
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            $cache = new Cache($row['id'], json_decode($row['order_data'], true), $row['ext_id'], $row['status']);
        }
        return $cache;
    }

    public function setStatus($cacheUUID, $status)
    {
        $sql = "update cache set status = :status where id = :uuid";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'uuid' => $cacheUUID,
            'status' => $status,
        ]);
    }
}
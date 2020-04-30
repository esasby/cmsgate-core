<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 17.01.2020
 * Time: 15:11
 */

namespace esas\cmsgate\utils;


use esas\cmsgate\Registry;

class FileWrapper
{

    private $name;
    private $path;
    private $dir;
    protected $logger;

    /**
     * FileWrapper constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->logger = Logger::getLogger(get_class($this));
        $this->name = pathinfo($path, PATHINFO_FILENAME) . '.' . pathinfo($path, PATHINFO_EXTENSION);
        $this->dir = pathinfo($path, PATHINFO_DIRNAME);
        $this->path = $path;
    }


    /**
     * @return bool
     */
    public function isExists()
    {
        if (!file_exists($this->getPath()) || is_dir($this->getPath())) {
            $this->logger->warn("File[" . $this->getPath() . "] does not exist");
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function fileSize()
    {
        return filesize($this->path);
    }

    public function read()
    {
        readfile($this->path);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        if (!unlink($this->path)) {
            $this->logger->warn('File[' . $this->getPath() . "] can not be deleted");
            Registry::getRegistry()->getMessenger()->addErrorMessage("Can not delete file[" . $this->path . "]");
            return false;
        } else {
            $this->logger->info('File[' . $this->getPath() . "] was deleted");
            return true;
        }
    }

    public function deleteIfExists()
    {
        if ($this->isExists())
            $this->delete();
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getDir()
    {
        return $this->dir;
    }
}
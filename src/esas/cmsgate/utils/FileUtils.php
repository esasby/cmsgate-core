<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 18.02.2020
 * Time: 13:51
 */

namespace esas\cmsgate\utils;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\Logger as CmsgateLogger;
use Exception;
use Throwable;

class FileUtils
{
    /**
     * Создает директорию с файлом .htaccess
     * Для ограничения доступа из вне к файлам логов
     * @param $dirname
     * @throws Exception
     */
    public static function createSafeDir($dirname)
    {
        if (!is_dir($dirname) && !mkdir($dirname)) {
            throw new Exception("Can not create dir[" . $dirname . "]. Please check permissions ");
        }
        $file = $dirname . '/.htaccess';
        if (!file_exists($file)) {
            $content =
                '<Files *.log>Deny from all</Files>' . PHP_EOL;
            file_put_contents($file, $content);
        }
    }

    /**
     * @param string $configFieldWithFileName
     * @throws Throwable
     */
    public static function downloadByConfigField($configFieldWithFileName)
    {
        $logger = CmsgateLogger::getLogger('FileDownload');
        $logger->info("Downloading file for field[" . $configFieldWithFileName . "]");
        $file = new UploadedFileWrapper(Registry::getRegistry()->getConfigWrapper()->getConfig($configFieldWithFileName));
        self::downloadByWrapper($file);
    }

    /**
     * @param string $filePath
     * @throws Throwable
     */
    public static function downloadByPath($filePath)
    {
        $logger = CmsgateLogger::getLogger('FileDownload');
        $logger->info("Downloading file by path[" . $filePath . "]");
        $file = new FileWrapper($filePath);
        self::downloadByWrapper($file);
    }

    /**
     * @param FileWrapper $file
     * @throws Throwable
     */
    public static function downloadByWrapper($file)
    {
        try {
            $logger = CmsgateLogger::getLogger('FileDownload');
            if (!$file->isExists()) {
                Registry::getRegistry()->getMessenger()->addErrorMessage("File[" . $file->getPath() . "] does not exist");
                return;
            } else
                $logger->info("File[" . $file->getPath() . "] will be downloaded");
            if (ob_get_level()) {
                ob_end_clean();
            }
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $file->getName());
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . $file->fileSize());
            $file->read();
            $logger->info('Done');
            exit();
        } catch (Throwable $e) {
            $logger->error("Exception! ", $e);
            throw $e;
        } catch (Exception $e) { // для совместимости с php 5
            $logger->error("Exception! ", $e);
            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    public static function uploadFile($configFieldWithFileName, $fileExtension = null)
    {
        try {
            $logger = CmsgateLogger::getLogger('FileUpload');
            if (!self::isPresentForUpload($_FILES[$configFieldWithFileName]))
                return;
            $logger->info("Uploading file for field[" . $configFieldWithFileName . "]");
            $uploadedFileExtension = strrchr($_FILES[$configFieldWithFileName]['name'], '.');
            if ($fileExtension != null && $uploadedFileExtension != $fileExtension)
                throw new Exception("Incorrect file type. [*." . $fileExtension . "] expected");
            $file = new UploadedFileWrapper(Registry::getRegistry()->getConfigWrapper()->getConfig($configFieldWithFileName));
            $file->deleteIfExists();
            $newFile = new UploadedFileWrapper(self::generateRandomName() . $uploadedFileExtension);
            FileUtils::createSafeDir($newFile->getDir());
            Registry::getRegistry()->getConfigWrapper()->saveConfig($configFieldWithFileName, $newFile->getName());
            move_uploaded_file($_FILES[$configFieldWithFileName]['tmp_name'], $newFile->getPath());
            Registry::getRegistry()->getMessenger()->addInfoMessage("File was uploaded to path[" . $newFile->getPath() . "]");
            $logger->info("Done");
        } catch (Throwable $e) {
            $logger->error("Exception! ", $e);
            throw $e;
        } catch (Exception $e) { // для совместимости с php 5
            $logger->error("Exception! ", $e);
            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    public static function uploadFiles()
    {
        try {
            $logger = CmsgateLogger::getLogger('FilesUpload');
            foreach ($_FILES as $configFieldWithFileName => $file) { //todo проверить что он есть в configFields
                self::uploadFile($configFieldWithFileName);
            }
            $logger->info("Done");
        } catch (Throwable $e) {
            $logger->error("Exception! ", $e);
            throw $e;
        } catch (Exception $e) { // для совместимости с php 5
            $logger->error("Exception! ", $e);
            throw $e;
        }
    }

    /**
     * @return boolean
     */
    public static function isPresentForUpload($fileMetaData)
    {
        if ($fileMetaData['name'] == '' && $fileMetaData['size'] == 0) // пропускаем не загруженные файлы
            return false;
        return true;
    }

    protected static function generateRandomName()
    {
        //Generate a random string.
        $token = openssl_random_pseudo_bytes(16);
        //Convert the binary data into hexadecimal representation.
        return bin2hex($token);
    }
}
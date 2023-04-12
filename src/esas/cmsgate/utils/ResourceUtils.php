<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 15.11.2018
 * Time: 13:02
 */

namespace esas\cmsgate\utils;


class ResourceUtils
{

    public static function getImageUrl($dir, $imageFileName)
    {
        return self::getResourceUrl($dir) . $imageFileName;
    }

    public static function getResourceUrl($resourcePath)
    {

        $resourceVirtualPath = self::getVirtualPath($resourcePath);
        // server protocol
        $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
        // domain name
        $domain = $_SERVER['SERVER_NAME'];
        $doc_root = $_SERVER['DOCUMENT_ROOT'];
        // base url
        $fileUrl = preg_replace("!^${doc_root}!", '', $resourceVirtualPath);
        // на всякий случай удаляем первый слэш
        $fileUrl = preg_replace("!^/!", '', $fileUrl);
        // server port
        $port = $_SERVER['SERVER_PORT'];
        $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
        // put em all together to get the complete base URL
        $url = "${protocol}://${domain}${disp_port}/${fileUrl}";
        return $url; // = http://example.com/path/directory
    }

    private static function getVirtualPath($path)
    {
        // finding symlink
        $script_path = $_SERVER["SCRIPT_FILENAME"];
        $script_real_path = realpath($script_path);
        if ($script_path != $script_real_path) {
            for ($script_path_i = strlen($script_path) - 1, $script_real_path_i = strlen($script_real_path) - 1;
                 $script_path_i >= 0 && $script_real_path_i >= 0;
                 $script_path_i--, $script_real_path_i--) {
                if ($script_path[$script_path_i] != $script_real_path[$script_real_path_i]) {
                    $real_part = StringUtils::substrBefore($script_real_path, $script_real_path_i + 2);
                    $virtual_part = StringUtils::substrBefore($script_path, $script_path_i + 2);
                    break;
                }
            }
        }

        return str_replace($real_part, $virtual_part, $path);
    }

    public static function getResourceDirUrl($resourcePath)
    {
        return self::getResourceUrl(dirname($resourcePath));
    }

}
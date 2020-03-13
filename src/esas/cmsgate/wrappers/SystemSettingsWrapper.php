<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 16.02.2018
 * Time: 13:39
 */

namespace esas\cmsgate\wrappers;

class SystemSettingsWrapper extends Wrapper
{
    /**
     * @return string
     */
    public function getCMSAdminEmail()
    {
        return 'n.mekh@hutkigrosh.by'; //todo
    }
}
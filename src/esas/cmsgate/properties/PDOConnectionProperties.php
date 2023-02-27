<?php


namespace esas\cmsgate\properties;


interface PDOConnectionProperties
{
    public function getPDO_DSN();

    public function getPDOUsername();

    public function getPDOPassword();
}
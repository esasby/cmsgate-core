<?php


namespace esas\cmsgate\properties;

interface ViewProperties extends Properties
{
    const BOOTSTRAP_V4 = 'bootstrap_V4';
    const BOOTSTRAP_V5 = 'bootstrap_V5';

    public function getBootstrapVersion();

}
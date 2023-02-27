<?php


namespace esas\cmsgate\utils\htmlbuilder\page;


use Exception;

class PageUtils
{
    /**
     * @param $page SingleFormPage
     */
    public static function validateFormInputAndRenderOnError($page) {
        try {
            $page->getForm()->validate();
        } catch (Exception $e) {
            $page->render();
            exit(0);
        }
    }
}
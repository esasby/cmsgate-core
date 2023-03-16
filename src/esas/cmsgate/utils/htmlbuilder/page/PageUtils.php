<?php


namespace esas\cmsgate\utils\htmlbuilder\page;


use esas\cmsgate\messenger\Messages;
use esas\cmsgate\Registry;
use Exception;

class PageUtils
{
    /**
     * @param $page SingleFormPage
     */
    public static function validateFormInputAndRenderOnError($page) {
        try {
            $managedFields = $page->getFormFields();
            $fieldsAreValid = $managedFields->validateAll($_REQUEST);
            $filesAreValid = $managedFields->validateAll($_FILES);
            if (!$fieldsAreValid || !$filesAreValid) {
                Registry::getRegistry()->getMessenger()->addErrorMessage(Messages::INCORRECT_INPUT);
                throw new Exception('Form is not valid');
            }
        } catch (Exception $e) {
            $page->render();
            exit(0);
        }
    }
}
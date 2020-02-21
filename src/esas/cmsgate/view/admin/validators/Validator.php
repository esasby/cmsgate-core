<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 11.10.2018
 * Time: 12:44
 */

namespace esas\cmsgate\view\admin\validators;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\Registry;
use Exception;
use Throwable;

/**
 * Class Validator используется для проверки корректности введенных значений
 * @package esas\cmsgate\view\admin\validators
 */
abstract class Validator
{
    protected $errorText;
    /**
     * @var Translator
     */
    protected $translator;

    /**
     * Validator constructor.
     * @param $errorText
     */
    public function __construct($vsprintfArgs = null)
    {
        $this->errorText = Registry::getRegistry()->getTranslator()->getValidationError(get_class($this));
        if ($vsprintfArgs != null)
            $this->errorText = vsprintf($this->errorText, $vsprintfArgs);
    }


    /**
     * @param $value
     * @return ValidationResult
     */
    public function validate($value)
    {
        $ret = new ValidationResult();
        if (!is_array($value)) // на случай валидации загружаемых файлов, в $value будет массив методанных по файлу и его в setValidatedValue не надо
            $ret->setValidatedValue($value);
        try {
            $ret->setValid($this->validateValue($value));
        } catch (Throwable $e) {
            $ret->setValid(false);
        } catch (Exception $e) { // для совместимости с php 5
            $ret->setValid(false);
        }
        if (!$ret->isValid()) {
            $ret->setErrorTextSimple($this->errorText);
        }
        return $ret;
    }

    /**
     * @return boolean
     */
    public abstract function validateValue($value);
}
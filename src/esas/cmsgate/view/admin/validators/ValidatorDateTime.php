<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 11.10.2018
 * Time: 13:29
 */

namespace esas\cmsgate\view\admin\validators;


use DateTime;

class ValidatorDateTime extends Validator
{
    private $format;
    private $acceptEmpty;

    /**
     * ValidatorNumber constructor.
     */
    public function __construct($format, $acceptEmpty = false)
    {
        parent::__construct($format);
        $this->format = $format;
        $this->acceptEmpty = $acceptEmpty;
    }


    /**
     * @return boolean
     */
    public function validateValue($value)
    {
        if ($this->acceptEmpty && empty($value))
            return true;
        $d = DateTime::createFromFormat($this->format, $value);
        return $d && $d->format($this->format) == $value;
    }
}
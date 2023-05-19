<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 11.10.2018
 * Time: 13:29
 */

namespace esas\cmsgate\view\admin\validators;


use DateTime;

class ValidatorDateTimeLocal extends Validator
{
    const DATE_TIME_LOCALE_FORMAT = 'Y-m-d\TH:i';
    private $acceptEmpty;

    /**
     * ValidatorNumber constructor.
     */
    public function __construct($acceptEmpty = false)
    {
        parent::__construct();
        $this->acceptEmpty = $acceptEmpty;
    }


    /**
     * @return boolean
     */
    public function validateValue($value)
    {
        if ($this->acceptEmpty && empty($value))
            return true;
        $d = DateTime::createFromFormat(self::DATE_TIME_LOCALE_FORMAT, $value);
        return $d && $d->format(self::DATE_TIME_LOCALE_FORMAT) == $value;
    }
}
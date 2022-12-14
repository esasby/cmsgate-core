<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 11.10.2018
 * Time: 13:29
 */

namespace esas\cmsgate\view\admin\validators;


class ValidatorInteger extends Validator
{
    private $min;
    private $max;

    /**
     * ValidatorNumber constructor.
     */
    public function __construct($min, $max)
    {
        parent::__construct([$min, $max]);
        $this->min = $min;
        $this->max = $max;
    }


    /**
     * @return boolean
     */
    public function validateValue($value)
    {
        if (!is_numeric($value))
            return false;
        $intValue = intval($value);
        return $intValue >= $this->min && $intValue <= $this->max;
    }
}
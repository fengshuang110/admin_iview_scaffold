<?php
namespace Validator\Lib;


class DatetimeValidator
{
    public function __construct($rule, $attribute, $params)
    {
        $datetime = $params[$attribute];
        if(empty($rule['format'])){
            throw new \LogicException("datetime is not format");
        }

        if (!$this->validateDateTime($datetime, $rule['format'])) {
            throw new \LogicException('Datetime format error');
        }
        return true;
    }
    private function validateDateTime($datetime, $format)
    {
        return date($format, strtotime($datetime)) === $datetime;
    }
}

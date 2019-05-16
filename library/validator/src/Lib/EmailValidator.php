<?php
namespace Validator\Lib;

class EmailValidator
{
    public function __construct($rule, $attribute, $params)
    {
        $value = $params[$attribute];

        if(filter_var($value, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        throw  new \LogicException("field $attribute Is Not a Email ");
    }
}

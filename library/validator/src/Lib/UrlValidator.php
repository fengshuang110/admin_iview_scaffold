<?php
namespace Validator\Lib;

class UrlValidator
{
    public function __construct($rule, $attribute, $params)
    {
        $value = $params[$attribute];

        if(filter_var($value, FILTER_VALIDATE_URL)){
            return true;
        }
        throw  new \LogicException("field $attribute Is Not a Url ");
    }
}

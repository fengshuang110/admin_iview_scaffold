<?php
namespace Validator\Lib;

class EnumValidator
{
    public function __construct($rule, $attribute, $params)
    {
        $value = $params[$attribute];

        if (empty($rule['domain'])){
            throw new \LogicException("Enum field $attribute empty domain");
        }
        $rule['domain'] = explode(',',$rule['domain']);
        if(in_array($value , $rule['domain'])){
            return true;
        }
        throw new \LogicException("Enum field $attribute Not In ".json_encode($rule['domain']));
    }
}

<?php
namespace Validator\Lib;

class ArrayValidator
{
    public function __construct($rule, $key, $param)
    {
        $arrayParam = $param;
        $this->min = isset($rule['min']) ? $rule['min'] : PHP_INT_MIN;
        $this->max = isset($rule['max']) ? $rule['max'] : PHP_INT_MAX;

        if (!is_array($arrayParam)) {
            throw new \LogicException("Array field $key Is Not Array ");
        }
        if (count($arrayParam) < $this->min) {
            throw new \LogicException("Array field $key Min Length is ".$this->min);
        }
        if (count($arrayParam) > $this->max) {
            throw new \LogicException("Array field $key Max Length is ".$this->max);
        }
        if(isset($rule['length'])){
            foreach ($arrayParam as $value){
                if (is_string($value) && mb_strlen($value) > $rule['length']) {
                    throw new \LogicException("Array field $key  value size is too large");
                }
            }
        }

    }
}

<?php
namespace Validator;

/**
 * @Annotation
 */
class ParamRules
{
    public function __construct($params)
    {
        $this->request = app()->get('request');
        $this->params = $params;
        $this->verifyParamsByRules($this->params);
    }
    public function verifyParamsByRules(array $paramRules)
    {
        $needValidationParamRules = [];
        $requiredOneOf = [];
        foreach ($paramRules as $param => $rule) {
            if (isset($rule['required']) && $rule['required'] === true) {
                if (!$this->hasParam($param)) {
                    throw new \LogicException('10002');
                }
            }

            if (isset($rule['required_together_with']) && is_array($rule['required_together_with'])) {
                if ($this->hasParam($param)) {
                    foreach ($rule['required_together_with'] as $requiredTogetherWithParam) {
                        if (!$this->hasParam($requiredTogetherWithParam)) {
                            throw new \LogicException('10002');
                        }
                    }
                }
            }

            if (isset($rule['mutually_exclusive_with']) && is_array($rule['mutually_exclusive_with'])) {
                if ($this->hasParam($param)) {
                    foreach ($rule['mutually_exclusive_with'] as $mutuallyExclusiveWithParam) {
                        if ($this->hasParam($mutuallyExclusiveWithParam)) {
                            throw new \LogicException('10002');
                        }
                    }
                }
            }

            if (isset($rule['required_one_of']) && $rule['required_one_of'] === true) {
                $requiredOneOf[] = $this->hasParam($param);
            }

            if (isset($rule['default'])) {
                $_REQUEST[$param] = $_REQUEST[$param] ?? $rule['default'];
            }

            if ($this->hasParam($param)) {
                $needValidationParamRules[$param] = $rule;
            }
        }

        if (count($requiredOneOf) != 0 && count(array_filter($requiredOneOf)) == 0) {
            throw new \LogicException('10002');
        }

        if (!empty($needValidationParamRules)) {
            foreach ($needValidationParamRules as $param => $rule){
                $className = 'Validator\\Lib\\' . ucfirst($rule['type']) .'Validator';
                new $className($rule, $param, $this->request->all());
            }
        }
    }

    private function hasParam($param)
    {
        return $this->request->has($param) || isset($_FILES[$param]);
    }
}
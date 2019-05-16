<?php
namespace Validator;

class Bootstrap{
    public static function init($className,$action){
        class_exists(ParamRules::class,true);
        $reader =  new \Doctrine\Common\Annotations\AnnotationReader();
        $reflectionClass = new \ReflectionClass($className);
        $reader->getMethodAnnotations($reflectionClass->getMethod($action));
    }
}
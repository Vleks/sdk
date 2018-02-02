<?php namespace Vleks\SDK;

use \ReflectionClass;

abstract class Enumerable
{
    public static function getAll()
    {
        $calledClass     = get_called_class();
        $reflectionClass = new ReflectionClass($calledClass);

        return $reflectionClass->getConstants();
    }
}

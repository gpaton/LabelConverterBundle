<?php

namespace Gpaton\LabelConverterBundle\Model;

class LabelConverterFactory
{
    private static $instances = array();

    /**
     * Create a converter based on conversion method wanted
     *
     * @param $method LabelConverter method to use
     * @param $integer integer to convert to label
     *
     * @throws \Exception
     * @return mixed
     */
    public static function getLabel ($method, $integer) {
        if (!isset(self::$instances[$method])) {

            // Generate full class name with converter methods namespace
            $namespaces = explode('\\', __NAMESPACE__);
            array_pop($namespaces);
            array_push($namespaces, 'LabelConverter', $method);
            $fullClassName = implode('\\', $namespaces);

            if (!class_exists($fullClassName)) {
                throw new LabelConverterException('Invalid label converter type');
            }
            self::$instances[$method] = new $fullClassName();
            $instance = self::$instances[$method];
        }
        else {
            $instance = self::$instances[$method];
        }

        if ($integer <= 0) {
            throw new LabelConverterException('Integer to convert must be a positive integer');
        }

        return $instance->getLabel($integer);
    }
}
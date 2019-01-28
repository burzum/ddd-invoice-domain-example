<?php
namespace Psa\Invoicing\Common;

use ArrayObject;
use ReflectionClass;

/**
 * Deconstruct
 */
class Deconstruct
{

    public static function toArray($object)
    {
        $object = clone $object;
        $reflect = new ReflectionClass($object);
        $properties = $reflect->getProperties();

        $array = new ArrayObject();
        foreach ($properties as $property) {
            if (!$property->isPublic()) {
                $property->setAccessible(true);
            }

            $value = $property->getValue($object);

            if (is_object($value)) {
                $array[$property->getName()] = static::toArray($value);
                continue;
            }
            $array[$property->getName()] = $value;
        }

        return $array;
    }
}

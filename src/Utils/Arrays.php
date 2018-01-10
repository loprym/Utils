<?php

/**
 * Class: Arrays
 *
 * Project Utils
 *
 * @category Class
 *
 * @file Arrays
 * @author loprym
 * @version 1.0 RC1
 *
 * @since 3.11.2017
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

/**
 * Utils for arrays
 */
class Arrays extends \Nette\Utils\Arrays {

    /**
     * Recursive convert array to object
     * @param array $array
     * @param string ...$keys arguments as keys
     * @return \stdClass
     */
    public static function arrayToObject(array $array, string ...$keys) : \stdClass {
	$object = new \stdClass();
	$cycle = (empty($keys)) ? \array_keys($array) : self::determineParameters($keys);
	foreach ($cycle as $key) {
	    if (isset($array[$key])) {
		$object->$key = (\is_array($array[$key])) ? self::arrayToObject($array[$key], \implode(',', $keys)) : $array[$key];
	    }
	}
	return $object;
    }

    /**
     * Recursive convert traversable object to array
     * @param \Traversable $object
     * @param string ...$methods enum of object method
     * @return array
     */
    public static function ObjectToArray(\Traversable $object, string ...$methods): array {
	$array = [];
	$cycle = (empty($methods)) ? NULL : \array_flip(self::determineParameters($methods));
	foreach ($object as $key => $value) {
	    if ($cycle === NULL || isset($cycle[$key]) || ($value instanceof \Traversable && \is_int($key) && !isset($cycle[$key]))) {
		$array[$key] = ($value instanceof \Traversable) ?
			empty($methods) ? self::objectToArray($value) : self::objectToArray($value, \implode(',', $methods)) :
			$value;
	    }
	}
	return $array;
    }


    /**
     * Is key set (whatewer, if he is NULL)
     * @param string $key
     * @param array $array
     * @return bool
     */
    public static function keyIsSet($key, $array) : bool {
	return (isset($array[$key]) || \array_key_exists($key, $array));
    }

    /**
     * Is value in array (no strict)
     * @param mixed $value
     * @param array $haystack
     * @return bool
     */
    public static function valueIsSet($value, array $haystack) : bool {
	return \in_array($value, $haystack);
    }

    /**
     * Explode multiple delimiters
     * @param array $delimiters
     * @param atring $string
     * @return array
     */
    public static function explode(array $delimiters, string $string) : array {
	$ready = \str_replace($delimiters, $delimiters[0], $string);
	return \array_filter(explode($delimiters[0], $ready));
    }

    /**
     * parse string 'key1, key2, ...' as array
     * @param array $parameters
     * @return array
     */
    public static function determineParameters($parameters): array {
	if (\is_array($parameters)) {
	    $result = (\count($parameters) === 1 && isset($parameters[0]) && \is_string($parameters[0])) ? self::explode([','], $parameters[0]) : $parameters;
	} else if (\is_string($parameters)) {
	    $result = self::explode([','], $parameters);
	}
	\array_walk($result, function(&$value) {
	    $value = \trim($value);
	});
	return \array_filter($result, function($value) {
	    return $value !== '';
	});
    }
}

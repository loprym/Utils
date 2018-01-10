<?php

/**
 * Class: Container
 *
 * Project Utils
 *
 * @category Class
 *
 * @file Container.php
 * @author loprym
 * @version 1.2
 *
 * @since 10.1.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use Loprym,
    Nette\SmartObject;

/**
 * Basic implementation of ArrayAccess, traversable (iterator) and count. work with iterable object
 *
 * @property-read array $keys
 * @property-read array $values 
 */
abstract class Container implements Loprym\IContainer {

    use SmartObject;

    /** @var iterable $container data container */
    protected $container = [];

    /** @var int $position */
    private $position = 0;

    /** @var array Array of keys */
    private $keys = NULL;

    /** @var array Array of values */
    private $values = NULL;

    /**
     * Its posible use whatewer iterable you want
     * @param iterable $container
     */
    protected function __construct(iterable $container = NULL) {
	if (isset($container)) {
	    $this->container = $container;
	}
    }

    /*************************BasicImplementation******************************/

    /**
     * Whether an offset exists
     * Offset may exist, but be NULL
     * @param mixed $offset
     * @return boolean
     */
    public function offsetExists($offset) {
	return Arrays::keyIsSet($offset, $this->container);
    }

    /**
     * Offset to retrieve
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset) {
	return Arrays::keyIsSet($offset, $this->container) ? $this->container[$offset] : NULL;
    }

    /**
     * Assign a value to the specified offset
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value) {
	if (is_null($value)) {
	    $this->container[] = $value;
	} else {
	    $this->container[$offset] = $value;
	}
	$this->keys = NULL;
    }

    /**
     * Unset an offset
     * @abstract
     * @param mixed $offset
     */
    public function offsetUnset($offset) {
	unset($this->container[$offset]);
	$this->keys = NULL;
    }

    /**
     * Get array of keys
     * @return array
     */
    public function getKeys(): array {
	if (is_array($this->container)) {
	    return array_keys($this->container);
	} else {
	    $this->setKeyAndValue();
	    return $this->keys;
	}
    }

    /**
     * Ged array of values
     * @return array
     */
    public function getValues(): array {
	if (is_array($this->container)) {
	    return array_values($this->container);
	} else {
	    $this->setKeyAndValue();
	    return $this->values;
	}
    }

    /**
     * Count stored item in object
     * @return int
     */
    public function count(): int {
	if (is_array($this->container)){
	    return count($this->container);
	}else {
	    return iterator_count($this->container);
	}
    }

    /**
     *  Rewind the Iterator to the first element
     * @return void
     */
    public function rewind() : void {
	$this->position = 0;
    }

    /**
     * Return the current element
     * @return mixed whatewer
     */
    public function current() {
	$this->prepareKeys();
	return ($this->valid()) ? $this->container[$this->key()] : FALSE;
    }

    /**
     * Return the key of the current element
     * @return scalar scalar on success, or NULL on failure.
     */
    public function key(){
	$this->prepareKeys();
	return $this->keys[$this->position];
    }

    /**
     * Move forward to next element
     * @return void
     */
    public function next() : void{
	++$this->position;
    }

    /**
     * Checks if current position is valid
     * @return bool
     */
    public function valid() : bool {
	$this->prepareKeys();
	return isset($this->keys[$this->position]);
    }

    /**
     * Convert object to array
     * @return array
     */
    public function toArray(): array {
	if (is_array($this->container)){
	    return $this->container;
	}else {
	    return iterator_to_array($this->container);
	}
    }

    /**
     * Serialize object
     * @abstract
     * @return string
     */
    abstract public function serialize(): string ;

    /**
     * unserialize object
     * @param string $serialized
     * @abstract
     */
    abstract public function unserialize($serialized);


    /****************************private***************************************/

    /**
     * store actual keys for foreaching etc...
     */
    private function prepareKeys() : void {
	if ($this->keys === NULL) {
	    $this->keys = $this->getKeys();
	}
    }

    /**
     * Only for non array object
     */
    private function setKeyAndValue() : void {
	    $array = iterator_to_array($this->container);
	    $this->keys = array_keys($array);
	    $this->values = array_values($array);
    }
}

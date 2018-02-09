<?php
/**
 * Class: TContainer
 *
 * Project Utils
 *
 * @category Class
 *
 * @file TContainer.php
 * @author loprym
 * @version 1.0
 *
 * @since 7.2.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Traits;

use Loprym\Utils\Arrays;
use Nette\SmartObject;

/**
 * Trait TContainer
 * @package Loprym\Traits
 *
 * @property-read array $keys
 * @property-read array $values
 * @property-read int $count
 */
trait TContainer
{

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
     * Whether an offset exists
     * Offset may exist, but be NULL
     * @param mixed $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return Arrays::keyIsSet($offset, $this->container);
    }

    /**
     * Offset to retrieve
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return Arrays::keyIsSet($offset, $this->container) ? $this->container[$offset] : NULL;
    }

    /**
     * Assign a value to the specified offset
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
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
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
        $this->keys = NULL;
    }

    /**
     * Get array of keys
     * @return array
     */
    public function getKeys(): array
    {
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
    public function getValues(): array
    {
        if (is_array($this->container)) {
            return \array_values($this->container);
        } else {
            $this->setKeyAndValue();
            return $this->values;
        }
    }

    /**
     * Count stored item in object
     * @return int
     */
    public function count(): int
    {
        if (is_array($this->container)) {
            return \count($this->container);
        } else if ($this->container instanceof \Traversable){
            return \iterator_count($this->container);
        }else {
            //hard way
            $result = 0;
            foreach ($this->container as $item){
                $result++;
            }
            return $result;
        }
    }

    public function getCount() : int {
        return $this->count();
    }

    /**
     *  Rewind the Iterator to the first element
     * @return void
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * Return the current element
     * @return mixed
     */
    public function &current()
    {
        $this->prepareKeys();
        return ($this->valid()) ? $this->container[$this->key()] : FALSE;
    }

    /**
     * Return the key of the current element
     * @return string on success, or NULL on failure.
     */
    public function key()
    {
        $this->prepareKeys() ;
        return $this->keys[$this->position];
    }

    /**
     * Move forward to next element
     * @return void
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * Checks if current position is valid
     * @return bool
     */
    public function valid(): bool
    {
        $this->prepareKeys();
        return isset($this->keys[$this->position]);
    }

    /**
     * Convert object to array
     * @return array
     */
    public function toArray(): array
    {
        if (is_array($this->container)) {
            return $this->container;
        } else if ($this->container instanceof \Traversable){
            return iterator_to_array($this->container);
        } else {
            //hard way (never happened)
            $result = [];
            foreach ($this->container as $key =>$item){
                $result[$key] = $item;
            }
            return $result;
        }
    }

    /****************************private***************************************/

    /**
     * store actual keys for foreach-ing etc...
     */
    private function prepareKeys(): void
    {
        if ($this->keys === NULL) {
            $this->keys = $this->getKeys();
        }
    }

    /**
     * Non array object only
     */
    private function setKeyAndValue(): void
    {
        $array = $this->$this->toArray();
        $this->keys = array_keys($array);
        $this->values = array_values($array);
    }
}
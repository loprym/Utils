<?php
/**
 * Class: TCascadeObject
 *
 * Project Utils
 *
 * @category Class
 *
 * @file TCascadeObject.php
 * @author loprym
 * @version 1.0
 *
 * @since 7.2.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Traits;


use Loprym\Utils\Arrays;
use Nette\MemberAccessException;
use Nette\SmartObject;

trait TCascadeObject
{

    use SmartObject;
    /**
     * @return mixed property or array as property value
     * @throws MemberAccessException if the property is not defined.
     */
    public function &__get($name)
    {
        try {
            return $this->traitGet($name);
        } catch (MemberAccessException $e) {
            if (isset($this->container[$name])) {
                if ($this->container[$name] instanceof \ArrayAccess || is_array($this->container[$name])) {
                    return $this->getObject($name);
                } else {
                    return $this->container[$name];
                }
            } else {
                throw $e;
            }
        }
    }

    /**
     * @return void
     */
    public function __set($name, $value)
    {
        try {
            $this->traitSet($name, $value);
        } catch (\Exception $e) {
            $this->container[$name] = $value;
        }
    }

    /**
     * @param $name offset
     */
    public function __unset($name)
    {
            unset($this->container[$name]);
    }

    /**
     * @return bool
     */
    public function __isset($name)
    {
        return (Arrays::keyIsSet($name, $this->container);
    }

    private function &getObject(string $offset)
    {
        if (!isset($this->object[$offset])) {
            $this->object[$offset] = new CascadeArray($this->container[$offset]);
        }
        return $this->object[$offset];

    }
}
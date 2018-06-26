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

use Loprym\Traits\TContainer;
use Loprym\Interfaces\IContainer;

/**
 * Basic implementation of ArrayAccess, traversable (iterator) and count. work with iterable object
 *
 * @property-read array $keys - Get object keys
 * @property-read array $values - Get object values
 * @property-read
 */
abstract class Container implements IContainer
{

    use TContainer;

    /**
     * It is possible use whatever iterable you want
     * @param iterable $container
     */
    public function __construct($container = NULL)
    {
        if (isset($container)) {
            $this->container = $container;
        }
    }

    /**
     * Serialize object
     * @abstract
     * @return string
     */
    abstract public function serialize(): string;

    /**
     * Unserialize object
     * @param string $serialized
     * @abstract
     */
    abstract public function unserialize($serialized);
}

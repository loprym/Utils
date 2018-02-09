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

use Loprym;

/**
 * Basic implementation of ArrayAccess, traversable (iterator) and count. work with iterable object
 *
 */
abstract class Container implements \ArrayAccess, \Iterator, \Countable
{

    use Loprym\Traits\TContainer;

    /**
     * It is possible use whatever iterable you want
     * @param iterable $container
     */
    public function __construct(iterable $container = NULL)
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

<?php
/**
 * Class: ArrayObject
 *
 * Project Utils
 *
 * @category Class
 *
 * @file ArrayObject
 * @author loprym
 * @version 1.0
 *
 * @since 25.1.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;


use Loprym\IContainer;
use Loprym\Traits\TContainer;
use Nette\MemberAccessException;


class CascadeArray implements \ArrayAccess
{

    /** @var IContainer */
    private $object;

    use TContainer;

    /**
     * It is possible use whatever iterable you want
     * @param iterable $container
     */
    public function __construct(iterable &$container = NULL)
    {
        if (isset($container)) {
            $this->container = &$container;
        }
    }

    /**
     * Serialize object
     * @return string
     */
    public
    function serialize(): string
    {
        return \serialize($this->container);
    }

    /**
     * Un-serialize object
     * @param string $serialized
     */
    public
    function unserialize($serialized)
    {
        $this->container = \unserialize($serialized);
    }
}
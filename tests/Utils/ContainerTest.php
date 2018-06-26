<?php
/**
 * Project Utils
 *
 * @category Class
 *
 * @file ContainerTest.php
 * @author loprym
 * @version 1.2
 *
 * @since 10.06.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{

    public function testUnserialize()
    {
        $array = ["one" => 1, "two" => "whatever"];
        $container = new ContainerMock($array);

        $actual = $container->serialize();
        $expected = serialize($array);
        $this->assertSame($expected, $actual);
    }

    public function testSerialize()
    {
        $array = ["one" => 1, "two" => "whatver"];
        $container = new ContainerMock($array);

        $actual = unserialize($container->serialize());
        $expected = $array;
        $this->assertSame($expected, $actual);
    }
}

Class ContainerMock extends Container
{

    public function __construct($container = NULL)
    {
        $this->container = $container;
        parent::__construct();
    }

    /**
     * Serialize object
     * @return string
     */
    public function serialize(): string
    {
        return \serialize($this->container);
    }

    /**
     * Un-serialize object
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $this->container = \unserialize($serialized);
    }
}

<?php
/**
 * Test: ContainerTest
 *
 * @package Loprym${PROJECT_NAME}
 *
 * @category Test
 *
 * @file Container.test.phpt
 * @author loprym
 * @version 1.0
 *
 * @since 8.2.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/..\bootstrap.php';

Class ContainerMock extends Container {

    public function __construct(iterable $container = NULL)
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
/**
 * @testCase
 */
class ContainerTest extends TestCase
{
    public function testSerialize(){
        $array = ["one" => 1, "two" => "whatever"];
        $container = new ContainerMock($array);

        $actual = $container->serialize();
        $expected = serialize($array);
        Assert::same($expected,$actual);
    }

    public function testUnserialize(){
        $array = ["one" => 1, "two" => "whatever"];
        $container = new ContainerMock($array);

        $actual = unserialize($container->serialize());
        $expected = $array;
        Assert::same($expected,$actual);
    }
}

(new ContainerTest())->run();
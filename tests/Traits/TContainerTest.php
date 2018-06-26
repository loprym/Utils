<?php
/**
 * Project Utils
 *
 * @category Test
 *
 * @file TContainerTest.php
 * @author loprym
 * @version 1.2
 *
 * @since 11.06.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Traits;

use PHPUnit\Framework\TestCase;

class TContainerTest extends TestCase
{

    public function arrayProvider()
    {
        RETURN
            [
                [
                    [
                        "one" => "one",
                        "two" => "two",
                        "there" => "three"
                    ]
                ],
                [
                    [
                        "one" => 1,
                        "two" => 2,
                        "there" => 3]
                ],
                [
                    [
                        "one" => "one",
                        "two" => "one = one; two = two",
                        "three" => NULL
                    ]]
            ];
    }

    /**
     * @dataProvider arrayProvider
     * @param $args
     */
    public function testOffsetExist($args)
    {
        $container = new TContainerMock($args);
        foreach ($args as $key => $val) {
            $this->assertTrue(isset($container[$key]));
        }

        $container = new TContainerObjectMock(new TContainerMock($args));
        foreach ($args as $key => $val) {
            $this->assertTrue(isset($container[$key]));
        }
    }

    /**
     * @dataProvider arrayProvider
     * @param $args
     */
    public function testOffsetGet($args)
    {
        $container = new TContainerMock($args);
        foreach ($args as $key => $val) {
            $this->assertSame($val, $container[$key]);
        }

        $args['get'] = 'whatever';
        $this->assertSame($args['get'], $container["get"]);
        unset($args['get']);


        $container = new TContainerObjectMock(new TContainerMock($args));
        $args['get'] = 'whatever';
        $this->assertSame($args['get'], $container["get"]);
        unset($args['get']);
    }

    /**
     * @dataProvider arrayProvider
     * @param $args
     */
    public function testOffsetSet($args)
    {
        $container = new TContainerMock($args);
        $container['set'] = 'whatever';
        $this->assertSame($args['set'], $container["set"]);
    }

    /**
     * @dataProvider arrayProvider
     * @param $args
     */
    public function testOffsetUnset($args)
    {
        $container = new TContainerMock($args);
        $container['unset'] = 'whatever';

        unset($container["unset"]);

        $this->assertFalse(isset($args['unset']));
        $this->assertFalse(isset($container["unset"]));
    }

    /**
     * @dataProvider arrayProvider
     * @param $args
     */
    public function testGetKeys($args)
    {
        $container = new TContainerMock($args);

        $expected = array_keys($args);
        $actual = $container->keys;
        $this->assertSame($expected, $actual);
    }

    /**
     * @dataProvider arrayProvider
     * @param $args
     */
    public function testGetValues($args)
    {
        $container = new TContainerMock($args);

        $expected = array_values($args);
        $actual = $container->values;
        $this->assertSame($expected, $actual);
    }

    /**
     * @dataProvider arrayProvider
     * @param $args
     */
    public function testCount($args)
    {
        $container = new TContainerMock($args);

        $expected = count($args);
        $actual = $container->count();
        $this->assertSame($expected, $actual);

        $actual = $container->count;
        $this->assertSame($expected, $actual);
    }

    /**
     * @dataProvider arrayProvider
     * @param $args
     */
    public function testGetArray($args)
    {
        $container = new TContainerMock($args);
        $this->assertSame($args, $container->getArray());
    }
}

class TContainerMock implements \ArrayAccess, \Iterator, \Countable
{

    use TContainer;

    public function __construct(&$container = NULL)
    {
        $this->container = &$container;
    }
}

class TContainerObjectMock implements \ArrayAccess, \Iterator, \Countable
{

    use TContainer;

    public function __construct($container = NULL)
    {
        $this->container = $container;
    }
}
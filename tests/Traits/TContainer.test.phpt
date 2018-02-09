<?php
/**
 * Test: TContainerTest
 *
 * @package Loprym${PROJECT_NAME}
 *
 * @category Test
 *
 * @file TContainer.test.phpt
 * @author loprym
 * @version 1.0
 *
 * @since 8.2.2018
 *
 * Encoding UTF-8
 * @dataProvider arrays.ini
 */

namespace Loprym\Traits;

use Loprym\Utils\ContainerMock;
use Tester;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/..\..\tests\bootstrap.php';


class TContainerMock implements \ArrayAccess, \Iterator, \Countable
{

    use TContainer;

    public function __construct(iterable &$container = NULL)
    {
        $this->container = &$container;
    }
}

class TContainerObjectMock implements \ArrayAccess, \Iterator, \Countable {
    use TContainer;

    public function __construct(iterable $container = NULL)
    {
        $this->container = $container;
    }
}

/**
 * @testCase
 */
class TContainerTest extends TestCase
{
    private $args;

    /**
     * @throws \Exception
     */
    Public function setUp()
    {
        $this->args = Tester\Environment::loadData();
    }

    public function testOffsetExist()
    {
        $container = new TContainerMock($this->args);
        foreach ($this->args as $key => $val) {
            Assert::true(isset($container[$key]));
        }

        $container = new TContainerObjectMock(new TContainerMock($this->args));
        foreach ($this->args as $key => $val) {
            Assert::true(isset($container[$key]));
        }
    }

    public function testOffsetGet()
    {
        $container = new TContainerMock($this->args);
        foreach ($this->args as $key => $val) {
            Assert::same($val, $container[$key]);
        }

        $this->args['get'] = 'whatever';
        Assert::same($this->args['get'], $container["get"]);
        unset($this->args['get']);


        $container = new TContainerObjectMock(new TContainerMock($this->args));
        $this->args['get'] = 'whatever';
        Assert::same($this->args['get'], $container["get"]);
        unset($this->args['get']);
    }

    public function testOffsetSet(){
        $container = new TContainerMock($this->args);
        $container['set'] = 'whatever';
        Assert::same($this->args['set'], $container["set"]);
    }

    public function testOffsetUnset(){
        $container = new TContainerMock($this->args);
        $container['unset'] = 'whatever';

        unset($container["unset"]);

        Assert::false(isset($this->args['unset']));
        Assert::false(isset($container["unset"]));
    }

    public function testGetKeys(){
        $container = new TContainerMock($this->args);

        $expected = array_keys($this->args);
        $actual = $container->keys;
        Assert::same($expected,$actual);
    }

    public function testGetValues(){
        $container = new TContainerMock($this->args);

        $expected = array_values($this->args);
        $actual = $container->values;
        Assert::same($expected,$actual);
    }

    public function testCount(){
        $container = new TContainerMock($this->args);

        $expected = count($this->args);
        $actual = $container->count();
        Assert::same($expected,$actual);

        $actual = $container->count;
        Assert::same($expected,$actual);
    }

    public function testToArray(){
        $container = new TContainerMock($this->args);
        Assert::same($this->args, $container->toArray());
    }
}

(new TContainerTest())->run();

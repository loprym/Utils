<?php
/**
 * Project Utils
 *
 * @category Class
 *
 * @file ArraysTest.php
 * @author loprym
 * @version 1.2
 *
 * @since 10.06.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use PHPUnit\Framework\TestCase;

class ArraysTest extends TestCase
{

    public function testArrayToObject()
    {
        $object = new \stdClass();
        $object->left = 1;
        $object->right = 2;
        $array = array('left' => 1, 'right' => 2);
        $actual = Arrays::arrayToObject($array);

        $this->assertInternalType('object', $actual);
        $this->assertEquals($object, $actual);
        $this->assertSame(1, $actual->left);
        $this->assertSame(2, $actual->right);

        $object = new \stdClass();
        $object->left = 1;
        $actual = Arrays::arrayToObject($array, 'left');
        $this->assertInternalType('object', $actual);
        $this->assertEquals($object, $actual);
        $this->assertSame(1, $actual->left);

        $object = new \stdClass();
        $object->right = 2;
        $actual = Arrays::arrayToObject($array, 'right');
        $this->assertInternalType('object', $actual);
        $this->assertEquals($object, $actual);
        $this->assertSame(2, $actual->right);

        $object = new \stdClass();
        $object->left = 1;
        $object->right = 2;
        $actual = Arrays::arrayToObject($array, 'left', 'right');
        $this->assertInternalType('object', $actual);
        $this->assertEquals($object, $actual);
        $this->assertSame(1, $actual->left);
        $this->assertSame(2, $actual->right);

        $actual = Arrays::arrayToObject($array, ' left ', ' right ');
        $this->assertInternalType('object', $actual);
        $this->assertEquals($object, $actual);
        $this->assertSame(1, $actual->left);
        $this->assertSame(2, $actual->right);

        $actual = Arrays::arrayToObject($array, ' left , right ');
        $this->assertInternalType('object', $actual);
        $this->assertEquals($object, $actual);
        $this->assertSame(1, $actual->left);
        $this->assertSame(2, $actual->right);


        $object->left = new \stdClass();
        $object->left->first = 1;
        $array['left'] = ['first' => 1];
        $actual = Arrays::arrayToObject($array, ' left , right, first ');
        $this->assertInternalType('object', $actual);
        $this->assertInternalType('object', $actual->left);
        $this->assertEquals($object, $actual);
        $this->assertSame(1, $actual->left->first);
        $this->assertSame(2, $actual->right);
    }

    public function testKeyIsSet()
    {
        $this->assertTrue(Arrays::keyIsSet(0, array('1', '2')));
        $this->assertFalse(Arrays::keyIsSet(2, array('1', '2')));
    }

    public function testValueIsSet()
    {
        $this->assertTrue(Arrays::valueIsSet(1, array('1', '2')));
        $this->assertFalse(Arrays::valueIsSet(3, array('1', '2')));
    }

    public function testObjectToArray()
    {
        $object = new ArraysMock();
        $object->left = 1;
        $object->right = 2;

        $array = array('left' => 1, 'right' => 2);
        $actual = Arrays::ObjectToarray($object);
        $this->assertInternalType('array', $actual);
        $this->assertSame($array, $actual);
        $this->assertSame(1, $actual['left']);
        $this->assertSame(2, $actual['right']);

        $array = array('left' => 1);
        $actual = Arrays::objectToArray($object, 'left');
        $this->assertInternalType('array', $actual);
        $this->assertSame($array, $actual);
        $this->assertSame(1, $actual['left']);

        $array = array('right' => 2);
        $actual = Arrays::objectToArray($object, 'right');
        $this->assertInternalType('array', $actual);
        $this->assertSame($array, $actual);
        $this->assertSame(2, $actual['right']);

        $array = array('left' => 1, 'right' => 2);
        $actual = Arrays::objectToArray($object, 'left', 'right');
        $this->assertInternalType('array', $actual);
        $this->assertSame($array, $actual);
        $this->assertSame(2, $actual['right']);
        $this->assertSame(1, $actual['left']);

        $actual = Arrays::objectToArray($object, ' left ', ' right ');
        $this->assertInternalType('array', $actual);
        $this->assertSame($array, $actual);
        $this->assertSame(2, $actual['right']);
        $this->assertSame(1, $actual['left']);

        $object->left = new ArraysMock();
        $object->left->first = 1;
        $array['left'] = ['first' => 1];
        $actual = Arrays::objectToArray($object, ' left , right, first ');
        $this->assertInternalType('array', $actual);
        $this->assertInternalType('array', $actual['left']);
        $this->assertSame($array, $actual);
        $this->assertSame(1, $actual['left']['first']);
        $this->assertSame(2, $actual['right']);
    }

    public function testDetermineParameters()
    {
        $expected = [0 => "asdf", 1 => "fdsa"];
        $array = ' asdf  ,   fdsa ,';
        $actual = Arrays::DetermineParameters($array);
        $this->assertSame($expected, $actual);
        $this->assertInternalType('array', $actual);
    }

    public function testIsAssoc()
    {
        $this->assertTrue(Arrays::isAssoc(["1" => 'a', "0" => 'b', "2" => 'c']));
        $this->assertTrue(Arrays::isAssoc(["a" => 'a', "b" => 'b', "c" => 'c']));
        $this->assertFalse(Arrays::isAssoc(["0" => 'a', "1" => 'b', "2" => 'c']));
        $this->assertFalse(Arrays::isAssoc(['a', 'b', 'c']));
    }
}

/**
 * Class ArraysMock
 * @package Loprym\Utils
 */
class ArraysMock implements \IteratorAggregate
{

    public function getIterator()
    {
        return new \ArrayIterator(get_object_vars($this));
    }
}
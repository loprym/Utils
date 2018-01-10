<?php

/**
 * TEST: Arrays.test
 *
 * @Package loprym\Utils
 *
 * @category Test
 * @file Arrays.test.phpt
 * @author loprym
 * @version 1.0
 *
 * @since 21.11.2015
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use Tester,
    Tester\Assert;

require __DIR__ . '/../bootstrap.php';

//require '../../src/Utils/Arrays.php';

class Mock implements \IteratorAggregate {

    public function getIterator() {
	return new \ArrayIterator(get_object_vars($this));
    }

}

/**
 * Main Tests
 */
class ArraysTest extends Tester\TestCase {

    function testArrayToObject() {
	$object = new \stdClass();
	$object->left = 1;
	$object->right = 2;
	$array = array('left' => 1, 'right' => 2);
	$actual = Arrays::arrayToObject($array);

	Assert::type('object', $actual);
	Assert::equal($object, $actual);
	Assert::same(1, $actual->left);
	Assert::same(2, $actual->right);

	$object = new \stdClass();
	$object->left = 1;
	$actual = Arrays::arrayToObject($array, 'left');
	Assert::type('object', $actual);
	Assert::equal($object, $actual);
	Assert::same(1, $actual->left);

	$object = new \stdClass();
	$object->right = 2;
	$actual = Arrays::arrayToObject($array, 'right');
	Assert::type('object', $actual);
	Assert::equal($object, $actual);
	Assert::same(2, $actual->right);

	$object = new \stdClass();
	$object->left = 1;
	$object->right = 2;
	$actual = Arrays::arrayToObject($array, 'left', 'right');
	Assert::type('object', $actual);
	Assert::equal($object, $actual);
	Assert::same(1, $actual->left);
	Assert::same(2, $actual->right);

	$actual = Arrays::arrayToObject($array, ' left ', ' right ');
	Assert::type('object', $actual);
	Assert::equal($object, $actual);
	Assert::same(1, $actual->left);
	Assert::same(2, $actual->right);

	$actual = Arrays::arrayToObject($array, ' left , right ');
	Assert::type('object', $actual);
	Assert::equal($object, $actual);
	Assert::same(1, $actual->left);
	Assert::same(2, $actual->right);



	$object->left = new \stdClass();
	$object->left->first = 1;
	$array['left'] = ['first' => 1];
	$actual = Arrays::arrayToObject($array, ' left , right, first ');
	Assert::type('object', $actual);
	Assert::type('object', $actual->left);
	Assert::equal($object, $actual);
	Assert::same(1, $actual->left->first);
	Assert::same(2, $actual->right);
    }

    function testObjectToArray() {


	$object = new Mock();
	$object->left = 1;
	$object->right = 2;
	$array = array('left' => 1, 'right' => 2);
	$actual = Arrays::ObjectToarray($object);
	Assert::type('array', $actual);
	Assert::same($array, $actual);
	Assert::same(1, $actual['left']);
	Assert::same(2, $actual['right']);

	$array = array('left' => 1);
	$actual = Arrays::objectToArray($object, 'left');
	Assert::type('array', $actual);
	Assert::same($array, $actual);
	Assert::same(1, $actual['left']);

	$array = array('right' => 2);
	$actual = Arrays::objectToArray($object, 'right');
	Assert::type('array', $actual);
	Assert::same($array, $actual);
	Assert::same(2, $actual['right']);

	$array = array('left' => 1, 'right' => 2);
	$actual = Arrays::objectToArray($object, 'left','right');
	Assert::type('array', $actual);
	Assert::same($array, $actual);
	Assert::same(2, $actual['right']);
	Assert::same(1, $actual['left']);

	$actual = Arrays::objectToArray($object, ' left ',' right ');
	Assert::type('array', $actual);
	Assert::same($array, $actual);
	Assert::same(2, $actual['right']);
	Assert::same(1, $actual['left']);

	$object->left = new Mock();
	$object->left->first = 1;
	$array['left'] = ['first' => 1];
	$actual = Arrays::objectToArray($object, ' left , right, first ');
	Assert::type('array', $actual);
	Assert::type('array', $actual['left']);
	Assert::same($array, $actual);
	Assert::same(1, $actual['left']['first']);
	Assert::same(2, $actual['right']);
    }

    function testKeyIsSet() {
	Assert::true(Arrays::keyIsSet(0, array('1', '2')));
	Assert::false(Arrays::keyIsSet(2, array('1', '2')));
    }

    function testValueIsSet(){
	Assert::true(Arrays::valueIsSet(1, array('1', '2')));
	Assert::false(Arrays::valueIsSet(3, array('1', '2')));
    }

    function testExplode() {
	$text = "here is a sample: this text, and this will be exploded. this also | this one too :)";

	$expected = Array(
	    'here is a sample',
	    ' this text',
	    ' and this will be exploded',
	    ' this also ',
	    ' this one too ',
	    ')');
	Assert::same($expected, Arrays::explode(array(",", ".", "|", ":"), $text));
    }

    function testDetermineParameters() {
	$expected = [0 => "asdf", 1 => "fdsa"];
	$array = ' asdf  ,   fdsa ,';
	$actual = Arrays::DetermineParameters($array);
	Assert::same($expected, $actual);
	Assert::type('array', $actual);
    }

}

$test = new ArraysTest();
$test->run();

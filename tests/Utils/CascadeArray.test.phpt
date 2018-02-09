<?php
/**
 * Test: CascadeArrayTest
 *
 * @package loprym\Utils
 *
 * @category Test
 *
 * @file CascadeArray.test.phpt
 * @author loprym
 * @version 1.0
 *
 * @since 25.1.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use Tester\Assert;
use Tester\TestCase;
use Tracy\Debugger;
use Tracy\Dumper;

require_once __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class CascadeArrayTest extends TestCase
{
    const TEST_ARRAY = ["one" => 1, "two" => ["one" => 1, "two"=> ["one" => [], "two"=> 1]]];

    public function testOffsetGet(){
        $array = self::TEST_ARRAY;
        $object = new CascadeArray($array);

        Assert::same($array["one"],$object["one"]);
        Assert::same($array["two"]["one"],$object["two"]["one"]);
        Assert::same($array["two"]["two"]["one"],$object["two"]["two"]["one"]);

        $array["one"] = 2;
        Assert::same($array["one"],$object["one"]);
    }


    public function test__get(){
        $array = self::TEST_ARRAY;
        $object = new CascadeArray($array);

        //primitive value
        Assert::same($array["one"], $object->one);
        Assert::same($array["two"]["one"], $object->two->one);

        //primitive value reference
        $array["one"] = 2;
        Assert::same($array["one"], $object->one);
        $array["two"]["one"] = 2;
        Assert::same($array["two"]["one"], $object->two->one);

        //multi dimensional array
        Assert::same($array["two"], $object->two->toArray());
        Assert::same($array["two"]["two"], $object->two["two"]);
        Assert::same($array["two"]["two"]["two"], $object->two->two["two"]);
    }

    public function test__set(){

        $array = self::TEST_ARRAY;
        $value = "whatever";
        $array["whatever"] = &$value;

        $object = new CascadeArray($array);

        //primitive value reference
        //$object->whatever = &$value;
        Assert::same($value, $object->whatever);
        //$object->whatever = &$value;
        Assert::same($value, $object->whatever);


        $value = ['whatever'];
        Assert::same($value, $object->whatever->toArray());



        //dump($object);
        //Assert::same($value, $object->whatewer);

        //$value = 1;
        //Assert::same($value, $object->whatewer);
    }

}
(new CascadeArrayTest())->run();
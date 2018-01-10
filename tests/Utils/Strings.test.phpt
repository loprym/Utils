<?php

/**
 * TEST: Strings.test
 *
 * @Package Loprym\Utils
 *
 * @category Test Class
 * @file Strings.test.phpt
 * @author loprym
 * @version 1.0
 *
 * @since 19.3.2016
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use Tester,
    Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * Main Tests
 */
class StringsTest extends Tester\TestCase {

    function testCutRight() {
	Assert::same('abc', Strings::cutRight('abc.abc', '.'));
	Assert::same('abc', Strings::cutRight('abc...abc', '.'));
    }

    function testCutLeft() {
	Assert::same('abc', Strings::cutLeft('abc.abc', '.'));
	Assert::same('abc', Strings::cutLeft('abc...abc', '.'));
    }

    function testExplode() {
	$text = "here is a sample: this text, and this will be exploded. this also | this one too :)";
	$test = Array(
	    'here is a sample',
	    ' this text',
	    ' and this will be exploded',
	    ' this also ',
	    ' this one too ',
	    ')');
	Assert::same($test, Strings::explode(array(",", ".", "|", ":"), $text));
    }

    function testGenerateKey(){
	Assert::type('string', Strings::GenerateKey('test'), "generated key muss be string");
	Assert::same(Strings::GenerateKey('test'),Strings::GenerateKey('test'),"generated keys muss be same");
    }
}

$test = new StringsTest();
$test->run();

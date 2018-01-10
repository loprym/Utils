<?php

/**
 * TEST: Parser.test
 *
 * @Package SBERP Tests
 *
 * @category Test
 * @file Parser.test.phpt
 * @author Jaromír Polášek
 * @version 1.2 NEON RC 2
 *
 * @since 17.10.2017
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use Tester,
    Tester\Assert;

require __DIR__ . '/../bootstrap.php';

define("DS", DIRECTORY_SEPARATOR);

/**
 * Main Tests class
 */
class NeonTest extends Tester\TestCase {

    const FULL_PATH_AND_FILE = __DIR__ . DS.'Files'. DS . 'whatewer.neon',
	    BASENAME = 'whatewer',
	    PATH = DS . 'Files' . DS,
	    EXP = '.neon';

    public function testPath() {
	$parser[] = new Neon(self::PATH, self::BASENAME . self::EXP);
	$parser[] = new Neon(self::PATH . '/' . self::BASENAME . self::EXP);

	$parser[] = new Neon(self::PATH, self::BASENAME);
	$parser[] = new Neon(self::PATH . '/' . self::BASENAME);

	foreach ($parser as $actual) {
	    foreach ($parser as $expected) {
		Assert::equal($expected->path, $actual->path);
	    }
	}
    }

    public function testToString() {
	$expected = \serialize(\Nette\Utils\FileSystem::read(self::FULL_PATH_AND_FILE));
	$actual = (new Neon(self::FULL_PATH_AND_FILE))->toString();

	Assert::same($expected, $actual);
    }

    public function testToNeon() {
	$expected = \Nette\Utils\FileSystem::read(self::FULL_PATH_AND_FILE);
	$actual = (new Neon(self::FULL_PATH_AND_FILE))->toNeon();
	Assert::same($expected, $actual);
    }

    public function testToArray() {
	$expected = \Nette\Neon\Neon::decode(\Nette\Utils\FileSystem::read(self::FULL_PATH_AND_FILE));
	$actual = (new Neon(self::FULL_PATH_AND_FILE))->toArray();
	Assert::same($expected, $actual);
    }

    public function testGetUpdate() {
	$expected = \filemtime(self::FULL_PATH_AND_FILE);
	$actual = (new Neon(self::FULL_PATH_AND_FILE))->timestamp;
	Assert::same($expected, $actual);
    }

}

$test = new NeonTest();
$test->run();

<?php

/**
 * TEST: Path.test
 *
 * @Package SBERP Tests
 *
 * @category Test
 * @file Path.test.phpt
 * @author Jaromír Polášek
 * @version 1.0
 *
 * @since 8.1.2018
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
class PathTest extends Tester\TestCase {



    const TEST_FILE_NAME = 'whatewer.txt';

    const ABSOLUTE_PATH = __DIR__ . DS . 'Files';

    public function testDownPath(){
	Assert::same('c:' . DS . 'www' . DS . 'Utils' ,Path::downPath('c:/www/Utils/Files'));
	Assert::same('c:' . DS . 'www' . DS . 'Utils' ,Path::downPath('c:/www/Utils/Files/'));
	Assert::same('c:' . DS . 'www' . DS . 'Utils' ,Path::downPath('c:/www/Utils/Files/'));

    }

    public function testCleanPath(){
	Assert::same('c:' . DS . 'www' . DS . 'index.php',Path::cleanPath('c:/www/../www/index.php'));
	Assert::same('c:' . DS . 'www' . DS . 'index.php',Path::cleanPath('c:/www/page/../../www/index.php'));
    }

    public function testExist(){
	//file exist
	$file = self::ABSOLUTE_PATH . DS . self::TEST_FILE_NAME;

	Assert::type('string',Path::exist($file), TRUE);
	Assert::type('string',Path::exist($file), FALSE);
	Assert::type('string',Path::exist($file));

	//change first letter in filenamu to Upper
	$file = self::ABSOLUTE_PATH . DS . ucfirst(self::TEST_FILE_NAME);

	Assert::type('string',Path::exist($file));
	Assert::null(Path::exist($file, TRUE));

	//all letters in filename are Upper
	$file = self::ABSOLUTE_PATH . DS . strtoupper(self::TEST_FILE_NAME);

	Assert::null(Path::exist($file, TRUE));
	Assert::same($file, Path::exist($file ));

	$file = self::ABSOLUTE_PATH . DS . 'wf.a';
	Assert::null(Path::exist($file));
    }
}

$test = new PathTest();
$test->run();



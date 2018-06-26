<?php
/**
 * Project Utils
 *
 * @category Class
 *
 * @file PathTest.php
 * @author loprym
 * @version 1.2
 *
 * @since 10.06.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use PHPUnit\Framework\TestCase;


class PathTest extends TestCase
{
    const DS = DIRECTORY_SEPARATOR;

    const TEST_FILE_NAME = 'whatewer.txt';

    const ABSOLUTE_PATH = __DIR__ . DS . 'Files' . DS;

    public function testExist()
    {
        //file exist
        $file = self::ABSOLUTE_PATH . DS . self::TEST_FILE_NAME;

        $this->assertInternalType('string', Path::exist($file, true));
        $this->assertInternalType('string', Path::exist($file, false));
        $this->assertInternalType('string', Path::exist($file));

        //change first letter in filename to Upper
        $file = self::ABSOLUTE_PATH . DS . ucfirst(self::TEST_FILE_NAME);

        $this->assertInternalType('string', Path::exist($file));
        $this->assertFalse(Path::exist($file, TRUE));

        //all letters in filename are Upper
        $file = self::ABSOLUTE_PATH . DS . strtoupper(self::TEST_FILE_NAME);

        $this->assertFalse(Path::exist($file, TRUE));
        $this->assertSame($file, Path::exist($file));

        $file = self::ABSOLUTE_PATH . DS . 'wf.a';
        $this->assertFalse(Path::exist($file));
    }

    public function testDownPath()
    {
        $this->assertSame('c:' . DS . 'www' . DS . 'Utils', Path::downPath('c:/www/Utils/Files'));
        $this->assertSame('c:' . DS . 'www' . DS . 'Utils', Path::downPath('c:/www/Utils/Files/'));
        $this->assertSame('c:' . DS . 'www' . DS . 'Utils', Path::downPath('c:/www/Utils/Files/'));
    }

    public function testCleanPath()
    {
        $this->assertSame('c:' . DS . 'www' . DS . 'index.php', Path::cleanPath('c:/www/../www/index.php'));
        $this->assertSame('c:' . DS . 'www' . DS . 'index.php', Path::cleanPath('c:/www/page/../../www/index.php'));
        $this->assertSame(DS . 'www' . DS . 'index.php', Path::cleanPath('www/../www/index.php'));
    }
}

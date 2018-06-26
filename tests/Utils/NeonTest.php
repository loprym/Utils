<?php
/**
 * Project Utils
 *
 * @category Class
 *
 * @file NeonTest.php
 * @author loprym
 * @version 1.2
 *
 * @since 10.06.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use Nette\Neon\Exception;
use PHPUnit\Framework\TestCase;

define("DS", DIRECTORY_SEPARATOR);

class NeonTest extends TestCase
{

    const FULL_PATH_AND_FILE = __DIR__ . DS . 'Files' . DS . 'whatewer.neon',
        BASENAME = 'whatewer',
        PATH = DS . 'Files' . DS,
        EXP = '.neon';

    public function testGetTimestamp()
    {
        $expected = \filemtime(self::FULL_PATH_AND_FILE);
        $actual = (new Neon(self::FULL_PATH_AND_FILE))->timestamp;
        $this->assertSame($expected, $actual);
    }

    public function testGetPath()
    {
        $parser[] = new Neon(self::PATH, self::BASENAME . self::EXP);
        $parser[] = new Neon(self::PATH . '/' . self::BASENAME . self::EXP);

        $parser[] = new Neon(self::PATH, self::BASENAME);
        $parser[] = new Neon(self::PATH . '/' . self::BASENAME);

        foreach ($parser as $actual) {
            foreach ($parser as $expected) {
                $this->assertEquals($expected->path, $actual->path);
            }
        }
    }

    public function testGetNeon()
    {
        $expected = \Nette\Utils\FileSystem::read(self::FULL_PATH_AND_FILE);
        $actual = (new Neon(self::FULL_PATH_AND_FILE))->getNeon();
        $this->assertSame($expected, $actual);

    }

    public function testGetArray()
    {
        $expected = \Nette\Neon\Neon::decode(\Nette\Utils\FileSystem::read(self::FULL_PATH_AND_FILE));
        try {
            $actual = (new Neon(self::FULL_PATH_AND_FILE))->getArray();
            $this->assertSame($expected, $actual);
        } catch (Exception $e) {
        };

    }

    public function test__toString()
    {
        $expected = \Nette\Utils\FileSystem::read(self::FULL_PATH_AND_FILE);
        $actual = (string)(new Neon(self::FULL_PATH_AND_FILE));
        $this->assertSame($expected, $actual);
    }
}

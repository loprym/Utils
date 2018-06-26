<?php
/**
 * Project Utils
 *
 * @category Class
 *
 * @file StringsTest.php
 * @author loprym
 * @version 1.2
 *
 * @since 10.06.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use PHPUnit\Framework\TestCase;

class StringsTest extends TestCase
{

    public function testExplode()
    {
        $text = "here is a sample: this text, and this will be exploded. this also | this one too :)";
        $test = Array(
            'here is a sample',
            ' this text',
            ' and this will be exploded',
            ' this also ',
            ' this one too ',
            ')');
        $this->assertSame($test, Strings::explode(array(",", ".", "|", ":"), $text));
    }

    public function testGenerateKey()
    {
        $this->assertSame(Strings::GenerateKey('test'), Strings::GenerateKey('test'), "generated keys muss be same");
    }

    public function testCutRight()
    {
        $this->assertSame('abc', Strings::cutRight('abc.abc', '.'));
        $this->assertSame('abc', Strings::cutRight('abc...abc', '.'));
    }

    public function testCutLeft()
    {
        $this->assertSame('abc', Strings::cutLeft('abc.abc', '.'));
        $this->assertSame('abc', Strings::cutLeft('abc...abc', '.'));
    }
}

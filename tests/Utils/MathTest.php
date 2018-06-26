<?php
/**
 * Project Utils
 *
 * @category Class
 *
 * @file MathTest.php
 * @author loprym
 * @version 1.2
 *
 * @since 17.06.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{

    public function orderNumProvider()
    {
        return
            [
                [[1, 2, 3, 4, 5, 6, 7, 8, 9], 5, 5],
                [[1, 2, 3, 4, 5, 6, 7, 8, 9, 10], 5.5, 5.5],
                [[2, 3, 5, 6, 7, 8, 9], 5.71, 6],
                [[1, 2, 3, 4, 5, 7, 8, 10], 5, 4.5],
                [[1, 2], 1.5, 1.5],
                [[2.1, 4.6, 6.12, 8.1], 5.23, 5.36],
                [[0.93, 3.92, 5.31, 7.52], 4.42, 4.62],
                [[1], 1, 1],
                [[2], 2, 2],
            ];
    }

    public function oddNumProvider()
    {
        return [[1, 3, 5, 7, 9, 13, 37, -5, -1]];
    }

    public function evenNumProvider()
    {
        return [[2, 4, 6, 8, 10, 12, 76, -4, -2]];
    }

    /**
     * @dataProvider oddNumProvider
     * @param $arg
     */
    public function testIsOdd($arg)
    {
        $this->assertTrue(Math::isOdd($arg));
        $this->assertFalse(Math::isEven($arg));
    }

    /**
     * @dataProvider evenNumProvider
     * @param $arg
     */
    public function testIsEven($arg)
    {
        $this->assertTrue(Math::isEven($arg));
        $this->assertFalse(Math::isOdd($arg));
    }

    /**
     * @dataProvider orderNumProvider
     * @param array $actual
     * @param float $expected
     * @param float $median
     */
    public function testArrayAverage(array $actual, float $average, float $median)
    {
        \shuffle($actual);
        $this->assertSame($average, Math::arrayAverage($actual, 2));
    }

    /**
     * @dataProvider orderNumProvider
     * @param array $actual
     * @param float $expected
     * @param float $median
     */
    public function testArrayMedian(array $actual, float $average, float $median)
    {
        \shuffle($actual);
        $this->assertSame($median, Math::arrayMedian($actual, 2));
    }
}

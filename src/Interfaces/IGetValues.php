<?php
/**
 * Project Utils
 *
 * @category interface
 *
 * @file IGetValues.php
 * @author loprym
 * @version 1.2
 *
 * @since 16.06.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Interfaces;

/**
 * Class IGetValues
 * @package Loprym\Interfaces
 *
 * @property-read array $values - Get values of object properties
 */
interface IGetValues
{

    /**
     * Get values of object
     * @return array
     */
    public function getValues(): array;
}

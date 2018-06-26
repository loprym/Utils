<?php
/**
 * Project Utils
 *
 * @category Class
 *
 * @file IGetArray.php
 * @author loprym
 * @version 1.2
 *
 * @since 09.06.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Interfaces;

/**
 * Interface IGetArray
 * @package Loprym\Interfaces
 *
 * @property-read array $array - Get array representation of object
 */
interface IGetArray
{
    /**
     * Get array representation of object
     * @return array
     */
    public function getArray(): array;
}
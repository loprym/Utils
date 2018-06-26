<?php
/**
 * Project Utils
 *
 * @category Class
 *
 * @file IGetKeys.php
 * @author loprym
 * @version 1.2
 *
 * @since 16.06.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Interfaces;

/**
 * Interface IGetKeys
 * @package Loprym\Interfaces
 *
 * @property-read array $keys - Get array of object keys
 */
interface IGetKeys
{

    /**
     * Get array of object keys
     * @return array
     */
    public function getKeys(): array;
}


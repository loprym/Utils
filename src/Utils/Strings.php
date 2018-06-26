<?php

/**
 * Class: Strings
 *
 * Project Utils
 *
 * @category Class
 *
 * @file Strings
 * @author loprym
 * @version 1.2
 *
 * @since 3.11.2017
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;


/**
 * Class Strings
 * @package Loprym\Utils
 */
class Strings extends \Nette\Utils\Strings
{

    /**
     * cut string TO first occurrence of...
     * @param string $haystack
     * @param string $needle
     * @return string
     */
    public static function cutRight($haystack, $needle): string
    {
        return \Nette\Utils\Strings::substring($haystack, 0, strpos($haystack, $needle));
    }

    /**
     * cut string FROM last occurrence of...
     * @param string $haystack
     * @param string $needle
     * @return string
     */
    public static function cutLeft($haystack, $needle): string
    {
        return \Nette\Utils\Strings::substring($haystack, strrpos($haystack, $needle) + 1, strlen($haystack));
    }

    /**
     * Explode multiple delimiters
     * @param array $delimiters
     * @param string $string
     * @return array
     */
    public static function explode(array $delimiters, string $string): array
    {
        return Arrays::explode($delimiters, $string);
    }

    /**
     * Calculate the md5 hash of a string
     * accessing (coping) use-full protected method from Nette\Caching\Casche
     * @copyright Copyright (c) 2004 David Grudl (https://davidgrudl.com)
     * @param mixed $key
     * @return string
     */
    public static function generateKey($key): string
    {
        return md5(is_scalar($key) ? (string)$key : serialize($key));
    }
}

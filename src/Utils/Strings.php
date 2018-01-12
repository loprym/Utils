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
 * @version 1.0 RC1
 *
 * @since 3.11.2017
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

/**
 * Utils for strings
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
     * @param atring $string
     * @return array
     */
    public static function explode(array $delimiters, string $string)
    {
        return Arrays::explode($delimiters, $string);
    }

    /**
     * Calculate the md5 hash of a string
     * accesing (coping) usefull protected method from Nette\Caching\Casche
     * @copyright Copyright (c) 2004 David Grudl (https://davidgrudl.com)
     * @param type $key
     * @return type
     */
    public static function generateKey($key): string
    {
        return md5(is_scalar($key) ? (string)$key : serialize($key));
    }
}

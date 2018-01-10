<?php

/**
 * Class: Path
 *
 * Project Loprym/Utils
 *
 * @category Class
 *
 * @file Path.php
 * @author loprym
 * @version 1.0
 *
 * @since 3.11.2017
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;


/**
 * Path and dir manipulation class
 */
class Path {



    /**
     * Decrease path by one level
     * @param string $path
     * @return string
     */
    public static function downPath(string $path): string {
	$tmp = Strings::explode(array('/', '\\'), $path);
	\array_pop($tmp);
	return \implode(DIRECTORY_SEPARATOR, $tmp);
    }

    /**
     * Clean a path (visual utility)
     * c:/a/b/c/../../../path/ -> c:/path
     * @param string $path
     * @return string
     */
    public static function cleanPath(string $path): string {
	$tmp = Strings::explode(array('/', '\\'), $path);
	$previous = NULL;
	foreach ($tmp as $key => $item) {
	    if ($item === '..' && $previous != NULL) {
		unset($tmp[$previous]);
		unset($tmp[$key]);
		$previous--;
	    } else {
		$previous = $key;
	    }
	}
	return \implode(DIRECTORY_SEPARATOR, $tmp);
    }

    /**
     * Existence of a file
     * default case-insensitive
     * @param string $file File Name
     * @param bool $caseSensitive cs on/off
     * @return string|null
     */
    public static function exist(string $file, $caseSensitive = false): ?string {
	$simple = \file_exists($file);
	if ($caseSensitive) {
	    return ($simple) ? self::caseSensitiveWin($file) : NULL;
	} else {
	    return ($simple) ? $file : self::caseInsensitiveUnix($file);
	}
    }

    /**
     * Windows case sensitive file compare
     * @param string $file
     * @return string|null
     */
    private static function caseSensitiveWin(string $file): ?string {
	$fileName = basename($file);
	//dump( 'zaklad' . $filename);
	foreach (\glob(\dirname($file) . DIRECTORY_SEPARATOR .'*', GLOB_NOSORT) as $item) {
	    if (\basename($item) === $fileName) {
		return $file;
	    }
	}
	return NULL;
    }

    /**
     * Unix case insensitive file compare
     * @param type $file
     * @return string|null
     */
    private static function caseInsensitiveUnix(string $file): ?string {
	$fileLC = \strtolower($file);
	foreach (\glob(\dirname($file) . DIRECTORY_SEPARATOR .'*', GLOB_NOSORT) as $item) {
	    if (\strtolower($item) === $fileLC) {
		return $item;
	    }
	}
	return NULL;
    }
}

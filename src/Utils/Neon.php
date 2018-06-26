<?php

/**
 * Class: Neon
 *
 * Project Utils
 *
 * @category Class
 *
 * @file Neon.php
 * @author loprym
 * @version 1.0
 *
 * @since 3.11.2017
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;

use Loprym\Interfaces\IGetArray;
use Loprym\Interfaces\IToString;
use
    Nette\SmartObject;

/**
 * Class Neon
 * @package Loprym\Utils
 *
 * @property-read string $path
 * @property-read int $timestamp
 * @property-read array $array
 * @property-read string $neon
 */
class Neon implements IGetArray, IToString
{

    use SmartObject;

    const EXP = '.neon';

    /** @var string File content */
    private $source = NULL;

    /** @var array of row data */
    private $content = NULL;

    /**
     * @param string $dir path to dir or path to file
     * @param string $file (optional) if is not included in first parameter
     */
    public function __construct(string $dir, string $file = NULL)
    {
        $path = ($file === NULL) ? $dir : $dir . DIRECTORY_SEPARATOR . $file;
        $pathInfo = \pathinfo($path);
        if (!isset($pathInfo['extension'])) {
            $pathInfo = \pathinfo($path . self::EXP);
        }
        $this->source = Path::cleanPath($pathInfo['dirname'] . DIRECTORY_SEPARATOR . $pathInfo['basename']);
    }

    /**
     * Get the path to the file
     * @return string
     */
    public function getPath(): string
    {
        return $this->source;
    }

    /**
     * Get the instance as neon content
     * @return array
     * @throws \Nette\Neon\Exception
     * @throws \Nette\IOException
     */
    public function getArray(): array
    {
        return \Nette\Neon\Neon::decode($this->getNeon());
    }

    /**
     * Get the instance as neon format content
     * @return string
     *
     */
    public function getNeon(): string
    {
        if (!isset($this->content)) {
            $this->content = \Nette\Utils\FileSystem::read($this->source);
        }
        return $this->content;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getNeon();
    }

    /**
     * Get the last update of file
     * @return int timestamp
     */
    public function getTimestamp(): int
    {
        return \filemtime($this->source);
    }
}

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

use Loprym,
    Nette\SmartObject;

/**
 * Object of neon file
 * @property-read string $path path to file
 * @property-read int $timestamp last update time
 */
class Neon{

    use SmartObject;

    const EXP = '.neon';

    /** @var string File content */
    private $source = NULL;

    /** @var array of row data */
    private $content = NULL;

    /**
     * @param string $dir path to dir or path to file
     * @param string $file (optional) if is not includet in first parameter
     */
    public function __construct(string $dir, string $file = NULL) {
	$path = ($file === NULL) ? $dir : $dir . DIRECTORY_SEPARATOR . $file;
	$pathInfo = \pathinfo($path);
	if (!isset($pathInfo['extension'])){
	    $pathInfo = \pathinfo($path . self::EXP);
	}
	$this->source = Path::cleanPath($pathInfo['dirname'] . DIRECTORY_SEPARATOR . $pathInfo['basename']);
    }

    public function __destruct()
    {
        $this->write();
    }

    /**
     * @param  string
     * @return ActiveRow|mixed
     * @throws Nette\MemberAccessException
     */
    public function &__get($key)
    {
        if ($this->accessColumn($key)) {
            return $this->data[$key];
        }

        $referenced = $this->table->getReferencedTable($this, $key);
        if ($referenced !== false) {
            $this->accessColumn($key, false);
            return $referenced;
        }

        $this->removeAccessColumn($key);
        $hint = Nette\Utils\ObjectMixin::getSuggestion(array_keys($this->data), $key);
        throw new Nette\MemberAccessException("Cannot read an undeclared column '$key'" . ($hint ? ", did you mean '$hint'?" : '.'));
    }
    /**
     * Get the path to the file
     * @return string
     */
    public function getPath() : string {
	return $this->source;
    }

    /**
     * Get the instance as neon content
     * @return array
     * @throws \Nette\Neon\Exception
     * @throws \Nette\IOException
     */
    public function toArray() : array {
	return \Nette\Neon\Neon::decode($this->toNeon());
    }

    /**
     * Get the instance as serialized string
     * @return string
     * @throws \Nette\Neon\Exception
     * @throws \Nette\IOException
     */
    public function toString() : string{
	return \serialize($this->toNeon());
    }

    /**
     * Get the instance as neon format content
     * @return string
     * @throws \Nette\Neon\Exception
     * @throws \Nette\IOException
     */
    public function toNeon() : string {
	if (!isset($this->content)){
	    $this->content = \Nette\Utils\FileSystem::read($this->source);
	}
	return $this->content;
    }

    /**
     * Get the last update of file
     * @return int timestamp
     */
    public function getTimestamp() : int{
	return \filemtime($this->source);
    }
}

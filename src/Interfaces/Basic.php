<?php

/**
 * Project Utils
 *
 * @category Interface
 *
 * @file basic.php
 * @author loprym
 * @version 1.0
 *
 * @since 9.1.2018
 *
 * Encoding UTF-8
 */

namespace Loprym;

/**
 * Interface IArrayable
 *
 * Get the instance as an array.
 */
interface IArrayable {

    public function toArray(): array;
}

/**
 * Interface IStringable
 *
 * Get the instance as string (serialize)
 */
interface IStringable {

    public function toString(): string;
}

/**
 * Interface INeonable
 *
 * Get the instance as neon content (string)
 */
interface INeonable {

    public function toNeon(): string;
}

/**
 * Interface IState
 *
 * Get state of object (whatewer)
 */
interface IStateable {

    public function getState(): bool;
}

/**
 * Interface IKeyable
 *
 * Get keys or indexes of object
 */
interface IKeyable extends \Iterator {

    public function getKeys(): array;
}

/**
 * Interface IValueable
 *
 * Get values of object
 */
interface IValueable extends \Iterator {

    public function getValues(): array;
}

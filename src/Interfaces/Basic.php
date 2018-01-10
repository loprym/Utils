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

    function toArray(): array;
}

/**
 * Interface IStringable
 *
 * Get the instance as string (serialize)
 */
interface IStringable {

    function toString(): string;
}

/**
 * Interface INeonable
 *
 * Get the instance as neon content (string)
 */
interface INeonable {

    function toNeon(): string;
}

/**
 * Interface IState
 *
 * Get state of object (whatewer)
 */
interface IStateable {

    function getState(): bool;
}

/**
 * Interface IKeyable
 *
 * Get keys or indexes of object
 */
interface IKeyable extends \Iterator {

    function getKeys(): array;
}

/**
 * Interface IValueable
 *
 * Get values of object
 */
interface IValueable extends \Iterator {

    function getValues(): array;
}

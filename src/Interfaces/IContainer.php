<?php

/**
 * Interface: IContainer
 *
 * Project Utils
 *
 * @category Interface
 *
 * @file IContainer.php
 * @author loprym
 * @version 1.2
 *
 * @since 10.1.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Interfaces;

/**
 * Interface IContainer
 *
 * @package Loprym
 */
interface IContainer extends \ArrayAccess, \Countable, \Serializable, \Traversable, \Iterator, IGetArray, IGetKeys, IGetValues
{
}
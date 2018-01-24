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

namespace Loprym;

/**
 * Interface IExportable
 * @package Loprym
 */
interface IExportable extends IArrayable, INeonable, IStringable {}

/**
 * Interface IContainer
 *
 * @package Loprym
 */
interface IContainer extends \ArrayAccess, \Countable, \Serializable, \Traversable, IArrayable{}

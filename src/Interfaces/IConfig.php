<?php
/**
 * Class: ${CLASS_NAME}
 *
 * Project Utils
 *
 * @category Class
 *
 * @file ${FILENAME}
 * @author loprym
 * @version
 *
 * @since 24.1.2018
 *
 * Encoding UTF-8
 */

namespace Loprym;


interface IConfig extends IArrayable, IStringable
{

    /**
     * Save configuration
     * @return bool
     */
    public function write() : bool;

    /**
     * Get the last update of configuration
     * @return int timestamp
     */
    public function getTimestamp() : int;
}
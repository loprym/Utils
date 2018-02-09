<?php
/**
 * Class: NullObject
 *
 * Project Utils
 *
 * @category Class
 *
 * @file NullObject.php
 * @author loprym
 * @version 1.0
 *
 * @since 1.2.2018
 *
 * Encoding UTF-8
 */

namespace Loprym\Utils;


class NullObject
{
    private $reference = NULL;

    public function __construct($reference)
    {
        $this->reference = $reference;
    }

    public function __isset($name = NULL)
{
    // TODO: Implement __isset() method.
}
}
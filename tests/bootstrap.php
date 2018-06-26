<?php
/**
 * Project Utils
 *
 * @category bootstrap
 *
 * @file bootstrap.php
 * @author loprym
 * @version 1.2
 *
 * @since 17.06.2018
 *
 * Encoding UTF-8
 */

require __DIR__ . '/../vendor/autoload.php';

\date_default_timezone_set('Europe/Prague');

$loader = new Nette\Loaders\RobotLoader;
$loader->addDirectory(__DIR__ . '/../src')
    //->setTempDirectory( __DIR__ . '/../temp')
    ->register();
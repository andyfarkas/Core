<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'Afa' . DIRECTORY_SEPARATOR . 'ClassLoader' . DIRECTORY_SEPARATOR . 'Loader.php');
$loader = new \Afa\ClassLoader\Loader();
$loader->addClasspath(__DIR__);
$loader->register();

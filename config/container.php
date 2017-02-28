<?php

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
//@todo hack disable cross origin
header("Access-Control-Allow-Origin: *");
// Load configuration
$config = require __DIR__ . '/config.php';

// Build container
$container = new ServiceManager();
(new Config($config['dependencies']))->configureServiceManager($container);

// Inject config
$container->setService('config', $config);

return $container;

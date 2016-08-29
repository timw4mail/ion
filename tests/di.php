<?php

use Aura\Html\HelperLocatorFactory;
use Aura\Session\SessionFactory;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response;

use Aviat\Ion\Config;
use Aviat\Ion\Di\Container;

// -----------------------------------------------------------------------------
// Setup DI container
// -----------------------------------------------------------------------------
return function(array $config_array = []) {
	$container = new Container();

	$container->set('config', function() {
		return new Config([]);
	});

	$container->setInstance('config', new Config($config_array));

	$container->set('request', function() {
		return ServerRequestFactory::fromGlobals(
			$_SERVER,
			$_GET,
			$_POST,
			$_COOKIE,
			$_FILES
		);
	});

	$container->set('response', function() {
		return new Response();
	});

	// Create session Object
	$container->set('session', function() {
		return (new SessionFactory())->newInstance($_COOKIE);
	});

	// Create Html helper Object
	$container->set('html-helper', function() {
		return (new HelperLocatorFactory)->newInstance();
	});

	return $container;
};
<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
require 'JsonView.php';

$app = new \Slim\Slim(array(
	'view' => new JsonView(),
	'debug' => FALSE,
));

// All Methods
require 'router.php';

// Generic error handler
$app->error(function (Exception $e) use ($app) {
	$app->render(array(
		'error' => TRUE,
		'alert' => $e->getMessage()
	), 500);
});

// Not found handler (invalid routes, invalid method types)
$app->notFound(function () use ($app) {
	$app->render(array(
		'error' => TRUE,
		'alert' => 'Invalid route'
	), 404);
});

// Handle Empty response body
$app->hook('slim.after.router', function () use ($app) {
	if (strlen($app->response()->body()) == 0) {
		$app->render(array(
			'error' => TRUE,
			'alert' => 'Empty response'
		), 500);
	}
});

$app->run();

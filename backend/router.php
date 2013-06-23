<?php

$app->get('/', function () use ($app) {
	$app->render(array('greeting' => 'hello!'));
});


$app->put('/v1/user/login/:login_email', function ( $login_email ) use ($app) {
	$app->render(array('get lost' => $login_email ));
});


$app->get('/v1/user/login/:login_email/:login_password', function ( $login_email, $login_password ) use ($app) {

	require_once( '/var/www/backend/session_manager.php' );
	$sessionManager = new SessionManagement ;
	$sKey = $sessionManager->startSession( $login_password, $login_email ) ;
	unset( $sessionManager );
	$app->render(array( 'sKey' => $sKey , 
						'first_name' => $_SESSION['user']['first_name'],
						'last_name'  => $_SESSION['user']['last_name'] ));
});


$app->get('/return', function () use ($app) {
	$app->render(array(
		$app->request()->getMethod(),
		$app->request()->headers(),
		$app->request()->params(),
		$app->request()->get('name')
	));
});


$app->get('/404', function () use ($app) {
	$app->render(array(
		'error' => TRUE,
		'alert' => 'Not found!'
	), 404);
});


$app->get('/500', function () use ($app) {
	$app->render(array(
		'success' => FALSE,
		'time'    => time()
	), 500);
});


$app->post('/post', function () use ($app) {

});


$app->put('/put', function () use ($app) {

});


$app->delete('/delete', function () use ($app) {
	throw new Exception('Shit happens!');
});

JsonRestAPI-ServerBootstrap
===========================

Minimal php rest api server app responses json objects (uses slim framework).
Simply handles the errors/exceptions and empty response objects very high-level and always returns a json object.


Install
-----------
This is a standalone php app requires no configuration. Just download and run.


Usage
-----------
You can define a new method in the router.php with any name and GET, POST, PUT, DELETE methods via
	
	$app->get('/hello', function () use ($app) {
		$app->render(array(
			'reply' => 'Hi!',
			'time' => time()
		));
	});

It returns the response object in JSON format.

	{
		"reply": "Hi!", 
		"time": 1363882949
	}


Dependencies
-----------
It uses Slim framework http://www.slimframework.com

<?php

class JsonView extends \Slim\View {

	var $status = 200;

	public function render($data) {
		$app = \Slim\Slim::getInstance();

		$app->response()->status($this->status);
		$app->response()->header('Content-Type', 'application/json');
		$app->response()->body(json_encode($data));
		$app->stop();
	}

	public function appendData($status = 200) {
		$this->status = $status;
	}

}
<?php

namespace frontend\controllers;

use Yii;

class BaseController extends \yii\web\Controller {

	protected $success = true;
	protected $errors = [];
	protected $data = [];
	protected $auth_actions = [];

	public function send($data) {
		return json_encode($data);
	}

	protected function _send($errors = []) {

		$this->errors = !empty($errors) ? $errors : $this->errors;

		if (!empty($this->errors)) {
			$this->success = false;
		}

		$response = [
			"success" => $this->success,
			"errors" => $this->errors,
			"data" => $this->data,
		];
		return $this->send($response);
	}
}
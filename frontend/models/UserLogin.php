<?php

namespace frontend\models;
use Yii;

class UserLogin extends Users {

	public function rules() {
		return [
			[['username', 'password'], 'required', 'on' => 'user-login'],
			[['user_token'], 'required', 'on' => 'logout'],
			[['user_token'], 'valiadteUserToken', 'on' => 'logout'],

		];
	}

	public function valiadteUserToken($attr, $params) {
		if ($this->user_token == Yii::$app->session->get("user_token")) {
			return true;
		}

		$this->addError("user_token", 'Invalid User Token');
		return false;

	}

}
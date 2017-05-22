<?php

namespace frontend\controllers;
use Yii;

class AuthController extends BaseController {

	protected $auth_actions = [];
	protected $role_actions = [];

	/**
	 * Called Before each action to check authentication
	 * @param type $event
	 * @return type
	 */
	public function beforeAction($event) {

		$action_id = Yii::$app->controller->action->id;
		$user_role = Yii::$app->session->get("user_role");
		if (in_array($action_id, $this->auth_actions) && !$this->isLogged()) {

			$this->errors = ["Access denied"];
			echo $this->_send();
			Yii::$app->end();
		} else if (in_array($action_id, $this->role_actions) && (!$this->isLogged() || empty($user_role))) {
			$this->errors = ["Access denied 1"];
			echo $this->_send();
			Yii::$app->end();
		}

		return parent::beforeAction($event);
	}

	protected function isLogged() {
		$userID = Yii::$app->session->get("user_id");
		$userToken = Yii::$app->request->get("user_token");
		if (!empty($userID) && !empty($userToken) && $userToken == Yii::$app->session->get("user_token")) {
			return true;
		}
		return false;
	}

}

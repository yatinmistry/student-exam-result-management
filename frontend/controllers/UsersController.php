<?php

namespace frontend\controllers;

use frontend\models\UserLogin;
use frontend\models\Users;
use frontend\models\UsersSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Session;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends AuthController {

	public $auth_actions = [
		'logout',
	];

	/**
	 * Login User
	 */
	public function actionLogin() {

		$model = new UserLogin();
		$model->scenario = 'user-login';
		$model->attributes = Yii::$app->request->get();

		if ($model->validate()) {
			$user = Users::find()
				->where([
					"username" => $model->username,
					'password' => md5($model->password),
				])
				->one();

			if ($user) {

				$token = $user->id . time() . rand(999, 9999);
				Yii::$app->session->set("user_id", $user->id);
				Yii::$app->session->set("user_token", $token);
				Yii::$app->session->set('user_role', $user->code);

				$this->data["token"] = $token;
			} else {
				$this->errors["user"] = "Invalid User";
			}

		} else {
			$this->errors = $model->errors;
		}

		return $this->_send();
	}

	/**
	 * Register New User
	 */
	public function actionRegister() {

		$model = new Users();
		$model->attributes = Yii::$app->request->get();

		if ($model->save()) {
			$this->data[] = "User added successfully " . $model->id . " " . $model->username;
		} else {
			$this->errors = $model->errors;
		}
		return $this->_send();

	}

	/**
	 * Logs out the current user.
	 */
	public function actionLogout() {

		$model = new UserLogin();
		$model->scenario = 'logout';
		$model->attributes = Yii::$app->request->get();

		if ($model->validate()) {
			Yii::$app->session->destroy();
			$this->data[] = 'Logout successfully';
		} else {
			$this->errors = $model->errors;
		}

		return $this->_send();
	}

	public function actionSession() {
		pe($_SESSION);
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Users models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new UsersSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Users model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Users model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Users();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Users model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Users model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Users model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Users the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Users::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}

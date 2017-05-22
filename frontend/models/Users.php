<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $email
 * @property string $code
 * @property string $created_on
 */
class Users extends \yii\db\ActiveRecord {

	public $user_token;
	public $rolesCodes = [
		"Teacher" => "FCV4RS",
		"Admin" => "WE32MN",
		"Student" => "",
	];

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'users';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['username', 'password', 'name', 'email'], 'required'],
			[['email'], 'email'],
			[['code'], 'safe'],
			[["code"], 'validateCode'],
			[['username'], 'unique'],
			[['created_on'], 'safe'],
			[['username'], 'string', 'max' => 30],
			[['password', 'name', 'email'], 'string', 'max' => 50],
			[['code'], 'string', 'max' => 6],
		];
	}

	public function validateCode($attr, $params) {
		if (!in_array($this->code, array_values($this->rolesCodes))) {
			$this->addError($attr, 'Invalid user code');
			return false;
		}
		return true;
	}

	public function beforeSave($insert) {
		if ($this->isNewRecord) {
			$this->password = md5($this->password);
		}
		return parent::beforeSave($insert);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'name' => 'Name',
			'email' => 'Email',
			'code' => 'Code',
			'created_on' => 'Created On',
		];
	}
}

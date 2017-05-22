<?php

namespace frontend\models;
use Yii;

class Students extends Users {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			// Student Create
			[['name', 'age', 'maths_marks', 'science_marks', 'english_marks'], 'required', 'on' => 'student-create'],
			[['age', 'maths_marks', 'science_marks', 'english_marks'], 'number', 'on' => 'student-create'],
			[['name'], 'string', 'max' => 50, 'on' => 'student-create'],

			// Student Edit
			[['id', 'name', 'age', 'maths_marks', 'science_marks', 'english_marks'], 'required', 'on' => 'student-edit'],
			[['age', 'maths_marks', 'science_marks', 'english_marks'], 'number', 'on' => 'student-edit'],
			[['name'], 'string', 'max' => 50, 'on' => 'student-edit'],
		];
	}

	public static function getStudentsList() {
		return self::find()
			->select("name,age,maths_marks,science_marks,english_marks,total_marks,percentage,rank")
			->where("CODE=''")
			->asArray()
			->all();
		return self::find()
			->select("name,age,maths_marks,science_marks,english_marks,(maths_marks+science_marks+english_marks) as total_marks,((maths_marks+science_marks+english_marks)*100/300) as percentage")
			->where("CODE=''")
			->asArray()
			->all();
	}

	public function afterSave($insert, $changedAttributes) {
		$students = self::find()
			->where("CODE=''")
			->all();
		$this->setTotalMarks();
		$this->setPercentage();
		$this->setRank();

		return parent::afterSave($insert, $changedAttributes);
	}

	private function setTotalMarks() {
		Yii::$app->db->createCommand("Update users SET total_marks =(maths_marks+science_marks+english_marks)")->execute();

	}

	private function setPercentage() {
		Yii::$app->db->createCommand("Update users SET percentage = ROUND((maths_marks+science_marks+english_marks)*100/300,2)")->execute();
	}

	private function setRank() {
		$students = self::find()
			->select("id,percentage")
			->where("CODE=''")
			->orderBy(["percentage" => SORT_DESC])
			->asArray()
			->all();
		$qry = '';
		foreach ($students as $key => $student) {
			$rank = $key + 1;
			$qry .= "Update users SET rank = {$rank} WHERE id = {$student["id"]};";

		}
		Yii::$app->db->createCommand($qry)->execute();

	}
}
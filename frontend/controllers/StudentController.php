<?php

namespace frontend\controllers;
use frontend\models\Students;
use Yii;

class StudentController extends AuthController {

	public $auth_actions = [
		'list',
		'add',
		'edit',
		'summary',
	];

	public $role_actions = [
		'add',
		'edit',
	];

	public function actionList() {

		$studentsArray = Students::getStudentsList();
		$this->data[] = $studentsArray;

		return $this->_send();
	}

	public function actionAdd() {
		$model = new Students();
		$model->scenario = 'student-create';
		$model->attributes = Yii::$app->request->get();
		if ($model->validate() && $model->save()) {
			$this->data[] = "Student added successfully";
		} else {
			$this->errors = $model->errors;
		}

		return $this->_send();
	}

	public function actionEdit() {
		$id = Yii::$app->request->get("id");
		$studentModel = Students::find()
			->where(["id" => $id])
			->one();
		if (!$studentModel) {
			return $this->_send(["Student not found"]);
		}

		$studentModel->scenario = 'student-edit';
		$studentModel->attributes = Yii::$app->request->get();

		if ($studentModel->validate() && $studentModel->save()) {
			$this->data[] = "Student updated successfully";
		} else {
			$this->errors = $model->errors;
		}

		return $this->_send();
	}

	public function actionSummary() {

		$students = Students::find()
			->where("CODE=''")
			->asArray()
			->all();
		if ($students) {

			$students_passed = $students_failed = 0;
			$maths_topper = $science_topper = $english_topper = $topper_student = [];
			foreach ($students as $key => $student) {
				if (empty($maths_topper)) {
					$maths_topper = $student;
				}
				if (empty($science_topper)) {
					$science_topper = $student;
				}
				if (empty($english_topper)) {
					$english_topper = $student;
				}
				if (empty($topper_student)) {
					$topper_student = $student;
				}

				if ($student["maths_marks"] < 40 || $student["science_marks"] < 40 || $student["english_marks"] < 40) {
					$students_failed++;
				} else {
					$students_passed++;
				}

				foreach (["maths_topper", 'science_topper', 'english_topper'] as $topper_type) {
					$topperTypeArr = explode("_", $topper_type);
					$subject = $topperTypeArr[0];
					$subject_marks = $subject . "_marks";
					if (!empty($$topper_type) && isset($$topper_type[$subject_marks]) && $student[$subject_marks] > $$topper_type[$subject_marks]) {
						$$topper_type = $student;
					}
				}

				$total_student_marks = $student["maths_marks"] + $student["science_marks"] + $student["english_marks"];
				if (!empty($topper_student) && isset($topper_student["id"])) {
					$total_topper_student_marks = $topper_student["maths_marks"] + $topper_student["science_marks"] + $topper_student["english_marks"];
					if ($total_student_marks > $total_topper_student_marks) {
						$topper_student = $student;
					}
				}
			}
			$this->data["students_passed"] = $students_passed;
			$this->data["students_failed"] = $students_failed;
			$this->data["maths_topper"] = $maths_topper["name"];
			$this->data["science_topper"] = $science_topper["name"];
			$this->data["english_topper"] = $english_topper["name"];
			$this->data["all_subject_topper"] = $topper_student["name"];

		} else {
			$this->errors["students"] = "Students not found";
		}

		return $this->_send();
	}

}
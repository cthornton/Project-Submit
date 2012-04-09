<?php
class CoursesController extends Controller {
  
  public function accessRules() {
    return array(
      array('allow', 'actions' => array('new'), 'roles' => array('admin', 'professor')),
      array('allow', 'actions' => array('logout', 'view', 'edit'), 'users' => array('@')),
      
      // Default to deny all other actions
      array('deny', 'users' => array('*')),
    );
  }
  
  
  public function actionNew() {
    $course = new Course;
    $course->user_id = $this->user->id;
    if($this->isPost) {
      $course->setAttributes($_POST['Course']);
      if($course->save()) {
        $this->flash('success', 'Course was created');
        return $this->redirect(array('courses/view', 'id' => $course->id));
      }
    }
    $this->render(array('course' => $course));
  }
  
  public function actionView() {
    $course = Course::model()->with(array('instructor', 'groups', 'students', 'assignments'))->findByPk($_GET['id']);
    $this->render(array('course' => $course));
  }
  
}
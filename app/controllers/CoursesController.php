<?php
class CoursesController extends Controller {
  
  public $layout = 'one_column';
  
  public function accessRules() {
    return array(
      array('allow', 'actions' => array('new'), 'roles' => array('admin', 'professor')),
      array('allow', 'actions' => array('logout', 'view', 'edit', 'index', 'all', 'enroll'), 'users' => array('@')),
      
      // Default to deny all other actions
      array('deny', 'users' => array('*')),
    );
  }
  
  public function actionIndex() {
    $this->layout = 'one_column';
    
    if($this->user->isProfessor) {
      $criteria = array(
        'with' => 'instructor',
        'condition' => 'open = 1 AND user_id = ' . $this->user->id,
        'order'     => 'name',
      );
    }
    
    if($this->user->isStudent) {
      $criteria = array(
        'with' => 'students',
        'together' => true,
        'condition' => 'open = 1 AND `students`.id = ' . $this->user->id,
        'order' => 't.name'
      );
    }
    if($this->user->isAdmin) {
      $criteria = array(
        'order' => 'name',
      );
    }
    $dataProvider = new CActiveDataProvider('Course', array(
      'criteria' => $criteria,
      'pagination' => array(
        'pageSize' => 20,
      ),
    ));
    $this->render(array('courses' => $dataProvider));
  }
  
  public function actionAll() {
    $dataProvider = new CActiveDataProvider('Course', array(
      'criteria' => array(
        'order' => 'name',
        'condition' => 'open = 1'
      ),
      'pagination' => array(
        'pageSize' => 20,
      ),
    ));
    $this->render(array('courses' => $dataProvider));
  }
  
  public function actionEnroll() {
    $course = Course::model()->findByPk($_GET['id']);
    $user   = User::model()->findByPk($_GET['user_id']);
    $this->requireAccess('ownItems', array('user_id' => $user->id));
    
    // If POST, enroll the user
    if($this->isPost) {
      if($course->isEnrolled($user)) {
        $this->flash('alert', 'User is already enrolled with this course');
      } else {
        $course->enrollUser($user);
        $this->flash("success", "Course enrollment successful");
        return $this->redirect(array('courses/all'));
      }
    }
    $this->render(array('course' => $course, 'user' => $user));
  }
  
  public function actionEdit() {
    $course = Course::model()->with('instructor')->findByPk($_GET['id']);
    $this->requireAccess('ownItems', array('user_id' => $course->instructor->id));
    if($this->isPost) {
      $course->setAttributes($_POST['Course']);
      if($course->save()) {
        $this->flash('success', 'Course was successfully updated');
        return $this->redirect(array('courses/view', 'id' => $course->id));
      }
    }
    $this->render(array('course' => $course));
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
    $course->isEnrolled($this->user);
    $assignments = new CActiveDataProvider('Assignment', array(
      'criteria' => array(
        'with' => 'course',
        'condition' => 't.course_id = course.id',
        'order'    => 'due_at DESC'
      ),
      'pagination' => array('pageSize' => 20),
    ));
    
    $groups = new CActiveDataProvider('Group', array(
      'criteria' => array(
        'with' => array('course', 'students'),
        'condition' => 'course.id = ' . $course->id
      ),
    ));
    
    $this->render(array('course' => $course, 'assignments' => $assignments, 'groups' => $groups));
  }
  
}
<?php
class AssignmentsController extends Controller {
  
  public $layout = 'one_column';
  
  public function accessRules() {
    return array(
      array('allow', 'actions' => array('new', 'edit', 'delete'), 'roles' => array('admin', 'professor')),
      array('allow', 'actions' => array('logout', 'view', 'edit', 'index'), 'users' => array('@')),
      
      // Default to deny all other actions
      array('deny', 'users' => array('*')),
    );
  }
  
  public function actionIndex() {
    if($this->user->isProfessor) {
      $criteria = array(
        'with' => 'course.instructor',
        'condition' => ' instructor.id = ' . $this->user->id,
        'order'     => '`t`.`due_at`, `t`.`name`',
      );
    }
    if($this->user->isStudent) {
      $criteria = array(
        'with' => 'course.students',
        'together' => true,
        'condition' => 'students.id = ' . $this->user->id,
      );
    }
    
    $dataProvider = new CActiveDataProvider('Assignment', array(
      'criteria' => $criteria,
      'pagination' => array(
        'pageSize' => 20,
      ),
    ));
    $this->render(array('assignments' => $dataProvider));
  }
  
  /**
   * @todo don't allow just anyone to view!
   */
  public function actionView() {
    $assignment = Assignment::model()->findByPk($_GET['id']);
    
    
    if($this->user->isStudent) {
      $criteria = array(
        'with' => array('group.students', 'user'),
        'together' => true,
        'condition' => 't.assignment_id = ' . $assignment->id . ' AND students.id = ' . $this->user->id,
        'order' => 't.submitted_at asc'
      );
    } else {
      $criteria = array(
        'with' => array('group', 'user'),
        'condition' => 'assignment_id = ' . $assignment->id,
        'order' => 't.submitted_at asc',
      );
    }
    
    $submissions = new CActiveDataProvider('Submission', array(
      'criteria' => $criteria
    ));
    
    
    $this->render(array('assignment' => $assignment, 'submissions' => $submissions));
  }
  
  
  public function actionNew() {
    $course = Course::model()->findByPk($_GET['course_id']);
    $this->requireAccess('ownItems', array('user_id' => $course->instructor->id));
    $assignment = new Assignment;
    $assignment->course = $course;
    $assignment->course_id = $course->id;
    
    if(isset($_POST['Assignment'])) {
      $assignment->setAttributes($_POST['Assignment']);
      if($assignment->save()) {
        $this->flash('success', 'Assignment has been created');
        return $this->redirect(array('assignments/view', 'id' => $assignment->id));
      }
    }
    $this->render(array('assignment' => $assignment));
  }
  
  public function actionEdit() {
    $assignment = Assignment::model()->with('course.instructor')->findByPk($_GET['id']);
    $this->requireAccess('ownItems', array('user_id' => $assignment->course->instructor->id));
    if(isset($_POST['Assignment'])) {
      $assignment->setAttributes($_POST['Assignment']);
      if($assignment->save()) {
        $this->flash('success', 'Assignment has been updated');
        return $this->redirect(array('assignments/view', 'id' => $assignment->id));
      }
    }
    $this->render(array('assignment' => $assignment));
  }
  
  public function actionDelete() {
    if($this->isPost()) {
      $assignment = Assignment::model()->with('course.instructor')->findByPk($_GET['id']);
      $this->requireAccess('ownItems', array('user_id' => $assignment->course->instructor->id));
      $assignment->delete();
      $this->flash('success', 'Assignment has been deleted');
      $this->redirect(array('courses/view', 'id' => $assignment->course->id));
    }
  }
  
}

?>
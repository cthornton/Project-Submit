<?php
class AssignmentsController extends Controller {
  
  public $layout = 'one_column';
  
  public function accessRules() {
    return array(
      array('allow', 'actions' => array('new'), 'roles' => array('admin', 'professor')),
      array('allow', 'actions' => array('logout', 'view', 'edit', 'index'), 'users' => array('@')),
      
      // Default to deny all other actions
      array('deny', 'users' => array('*')),
    );
  }
  
  public function actionIndex() {
    
    if($this->user->isProfessor) {
      $criteria = array(
        'with' => 'course.instructor',
        'condition' => '`users.`id` = ' . $this->user->id,
        'order'     => 'due_at, name',
      );
    }
    if($this->user->isAdmin)     $courses = Course::model();
    
    $dataProvider = new CActiveDataProvider('Assignment', array(
      'criteria' => $criteria,
      'pagination' => array(
        'pageSize' => 20,
      ),
    ));
    
    
    $this->render(array('assignments' => $dataProvider));
  }
  
}

?>
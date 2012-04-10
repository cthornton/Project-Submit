<?php
class SubmissionsController extends Controller {
  
  public $layout = 'one_column';
  
  public function accessRules() {
    return array(
      array('allow', 'actions' => array('new', 'edit', 'delete'), 'roles' => array('admin', 'professor')),
      array('allow', 'actions' => array('logout', 'view', 'edit', 'index', 'new'), 'users' => array('@')),
      
      // Default to deny all other actions
      array('deny', 'users' => array('*')),
    );
  }
 
  public function actionNew() {
    $submission = new Submission;
    $assignment = Assignment::model()->findByPk($_GET['assignment_id']);
    $submission->assignment_id = $assignment->id;
    
    $this->render(array('assignment' => $assignment));
  }
  
  
}
  
?>
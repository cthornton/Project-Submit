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
    $assignment = Assignment::model()->with('course')->findByPk($_GET['assignment_id']);
    $submission->assignment = $assignment;
    $submission->assignment_id = $assignment->id;
    $submission->user_id = $this->user->id;
    $submission->user = $this->user;
    if(!$assignment->course->isEnrolled($this->user))
      throw new CHttpException(403, "You cannot submit an assignment for a course which you are not enrolled for!");
    
    if(isset($_POST['Submission'])) {
      $submission->setAttributes($_POST['Submission']);
      $submission->submitted_at = new CDbExpression('NOW()');
      
      $group = Group::model()->findByPk($submission->group);
      
      // Ensure we're only submitting our own group
      if(!$group->inGroup($this->user))
        throw new CHttpException(403, "You cannot submit on behalf of a group that you are not part of");
        
      $attachment = CUploadedFile::getInstance($submission, 'attachment');
      $submission->file_name = $attachment->name;
      $submission->file_size = $attachment->size;
      $submission->file_type = $attachment->type;
        
      if($submission->save()) {
        $attachment->saveAs(Yii::app()->basePath . '/data/uploads/submission_' . $submission->id . '.dat');
        $this->flash('success', 'Submission was successful');
        return $this->redirect(array('submissions/view', 'id' => $submission->id));
      }
    }
    
    $this->render(array('submission' => $submission));
  }
  
  
}
  
?>
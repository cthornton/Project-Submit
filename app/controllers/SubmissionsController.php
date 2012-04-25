<?php
class SubmissionsController extends Controller {
  
  public $layout = 'one_column';
  
  public function accessRules() {
    return array(
      array('allow', 'actions' => array('logout', 'view', 'edit', 'index', 'new', 'download'), 'users' => array('@')),
      
      // Default to deny all other actions
      array('deny', 'users' => array('*')),
    );
  }
  
  public function actionView() {
    $submission = Submission::model()->with(array('assignment.course', 'group'))->findByPk($_GET['id']);
    
    // Only allow instructors or people in the group to view the submission
    if($submission->assignment->course->user_id && !$submission->group->inGroup($this->user))
      throw new CHttpException(403, "You do not have permission to view this page");
      
    $this->render(array('submission' => $submission));
  }
  
  public function actionDownload() {
    $submission = Submission::model()->with(array('assignment.course', 'group'))->findByPk($_GET['id']);
    
    // Only allow instructors or people in the group to view the submission
    if($submission->assignment->course->user_id && !$submission->group->inGroup($this->user))
      throw new CHttpException(403, "You do not have permission to view this page");
      
    if(empty($submission->file_name) || !file_exists($submission->localFilePath))
      throw new CHttpException(404, "The requested submission does not have a file attachment");
    
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $submission->file_type);
    header('Content-Disposition: attachment; filename='.basename($submission->file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . $submission->file_size);
    ob_clean();
    flush();
    readfile($submission->localFilePath);
    exit;
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
      $submission->course_group_id = $group->id;
      
      // Ensure we're only submitting our own group
      if(!$group->inGroup($this->user))
        throw new CHttpException(403, "You cannot submit on behalf of a group that you are not part of");
        
      $attachment = CUploadedFile::getInstance($submission, 'attachment');
      if(!empty($attachment)) {
        $submission->file_name = $attachment->name;
        $submission->file_size = $attachment->size;
        $submission->file_type = $attachment->type;
      }
        
      if($submission->save()) {
        if(!empty($attachment))
          $attachment->saveAs($submission->localFilePath);
        $this->flash('success', 'Submission was successful');
        return $this->redirect(array('submissions/view', 'id' => $submission->id));
      }
    }
    
    $this->render(array('submission' => $submission));
  }
  
  
}
  
?>
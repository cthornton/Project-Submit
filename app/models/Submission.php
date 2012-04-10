<?php
class Submission extends ModelBase {


  public $attachment;

  public function rules() {
    return array(
      array('title, description', 'safe'),
      array('assignment, user, group, submitted_at', 'required'),
      array('attachment', 'file', 'maxSize' =>  10485760, 'allowEmpty' => true),
    );
  }


  public function relations() {
    return array(
      'assignment' => array(self::BELONGS_TO, 'Assignment', 'assignment_id'),
      'user'       => array(self::BELONGS_TO, 'User', 'user_id'),
      'group'      => array(self::BELONGS_TO, 'Group', 'course_group_id')
    );
  }
  
  
  public function getLocalFilePath() {
    return Yii::app()->basePath . '/data/uploads/submission_' . $this->id . '.dat';
  }
  
  public function getIsLate() {
    $due = $this->assignment->timestampize('due_at');
    $submitted = $this->timestampize('submitted_at');
    return ($due - $submitted) <= 0;
  }
  
}
?>
<?php
class Assignment extends ModelBase {

  public function rules() {
    return array(
      array('name, description, due_at, course, max_points', 'required'),
      array('due_at', 'date', 'format' => APP_TIMESTAMP),
      array('max_points', 'numerical', 'integerOnly' => true, 'min' => 1)
    );
  }
  

  public function relations() {
    return array(
      'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
      'submission' => array(self::HAS_MANY, 'Submission', 'assignment_id')
    );
  }
  
}
?>
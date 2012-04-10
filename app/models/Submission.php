<?php
class Assignment extends ModelBase {

  public function relations() {
    return array(
      'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
    );
  }
  
}
?>
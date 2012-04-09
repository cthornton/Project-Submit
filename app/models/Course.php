<?php
class Course extends ModelBase {

  public function rules() {
    return array(
      array('instructor', 'unsafe'),
      array('name, description, open, instructor', 'required'),
      array('open', 'boolean'),
    );
  }
  
  public function relations() {
    return array(
      'instructor' => array(self::BELONGS_TO, 'User', 'user_id'),
      'groups' => array(self::HAS_MANY, 'Group', 'course_id'),
      'students' => array(self::MANY_MANY, 'User', 'courses_users(user_id, course_id)'),
      'assignments' => array(self::HAS_MANY, 'Assignment', 'course_id'),
    );
  }
  
  
}
?>
<?php
class Group extends ModelBase {
  
  public function tableName() {
    return 'course_groups';
  }
  
  public function relations() {
    return array(
      'user' => array(self::MANY_MANY, 'User', 'course_groups_users(course_group_id,user_id)'),
      'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
    );
  }
  
}
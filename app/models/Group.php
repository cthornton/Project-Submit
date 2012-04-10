<?php
class Group extends ModelBase {
  
  public function tableName() {
    return 'course_groups';
  }
  
  public function rules() {
    return array(
      array('name, course', 'required'),
    );
  }
  
  public function relations() {
    return array(
      'students' => array(self::MANY_MANY, 'User', 'course_groups_users(course_group_id,user_id)'),
      'studentCount' => array(self::STAT, 'User', 'course_groups_users(course_group_id,user_id)'),
      'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
    );
  }
  
  public function canAccess(User $user) {
    if($user->isAdmin)
      return true;
    if($user->isProfessor)
      return $this->course->user_id = $user->id;
    
    $res = Group::model()->with(array('course.students' => array(
      'condition' => 'students.id = ' . $user->id,
    )))->findAll();
    
    return count($res) != 0; 
  }
  
  public function inGroup(User $user) {
    $res = Yii::app()->db->createCommand()
      ->select("COUNT(*) AS num")
      ->from('course_groups_users')
      ->where("course_group_id = :gid AND user_id = :uid", array(':gid' => $this->id, ':uid' => $user->id))
      ->queryAll();
    return $res[0]["num"] != 0;
  }
  
  public function addUser(User $user) {
    if($this->inGroup($user))
      throw new Exception("User '{$user->id}' is already part of group '{$this->id}'");
    Yii::app()->db->createCommand()->insert('course_groups_users', array('course_group_id' => $this->id, 'user_id' => $user->id));
  }
  
}
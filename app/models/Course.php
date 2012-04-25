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
      'instructor'  => array(self::BELONGS_TO, 'User', 'user_id'),
      'groups'      => array(self::HAS_MANY, 'Group', 'course_id'),
      'students'    => array(self::MANY_MANY, 'User', 'courses_users(course_id, user_id)'),
      'assignments' => array(self::HAS_MANY, 'Assignment', 'course_id'),
    );
  }
  
  
  /**
   * Enrolls a user in this course
   */
  public function enrollUser(User $user) {
    Yii::app()->db->createCommand()->insert('courses_users', array('course_id' => $this->id, 'user_id' => $user->id));
  }
  
  public function isEnrolled($user) {
    if(is_int($user))
      $user_id = $user;
    else
      $user_id = $user->id;
    $res = Yii::app()->db->createCommand()
      ->select("COUNT(*) AS num")
      ->from('courses_users')
      ->where("course_id = :course AND user_id = :user", array(':course' => $this->id, ':user' => $user_id))
      ->queryAll();
    return $res[0]["num"] != 0;
  }
  
}
?>
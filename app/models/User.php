<?php

class User extends ModelBase {
  
  
  public $password_confirmation, $password;
  
  /**
   * Used for changing passwords
   */
  public $change_password = false;
  
  
  public function getFullName() {
    return $this->first_name . " " . $this->last_name;
  }
  
  public static function idToRoleName($userId = null) {
    if(empty($userId)) return "";
    $user =  User::model()->with(array('role' => array('select' => 'system_name')))->findByPk($userId);
    if(empty($user->role)) return "";
  }
  
  public function relations() {
    return array(
      'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
      'courses' => array(self::HAS_MANY, 'Course', 'user_id'),
      'groups'  => array(self::MANY_MANY, 'Group', 'course_groups_users(user_id, course_group_id)'),
      'enrolls' => array(self::MANY_MANY, 'Course', 'courses_users(course_id, user_id)')
    );
  }
  
  
  public function attributeLabels() {
    return array('role' => 'User Type');
  }
  
  public function getIsProfessor() {
    return $this->role->system_name == 'professor';
  }
  
  public function getIsAdmin() {
    return $this->role->system_name == 'admin';
  }
  
  public function getIsStudent() {
    return $this->role->system_name == 'student';
  }
  
  
  public function rules() {
    return array(

      // Unsafe Attributes by default
      array('role', 'unsafe'),
      array('password_confirmation', 'safe'),

      // Allow role assignment if it's a "safe" role only on register
      array('role_id', 'in', 'range' => array(2, 3), 'on' => 'register'),
      
      array('username, email, first_name, last_name, role', 'required'),
      array('password, password_confirmation', 'required', 'on' => 'register'),
      array('username, email', 'unique'),
      array('email', 'email'),
      array('password', 'length', 'min' => 6, 'max' => 32, 'allowEmpty' => true),
      array('password', 'compare', 'compareAttribute' => 'password_confirmation'),
      array('password_confirmation', 'safe', 'on' => 'register'),

    );
  }
  
  
  public function authenticate() {    
    $found_user = User::model()->find('username = :u AND hashed_password = :p', array('u' => $this->username, 'p' => User::hashPassword($this->password)));
    if($found_user == null)
      $this->addError("username", "Invalid username or password");
    return $found_user;
  }

  public function beforeUpdate() {
    if(!empty($this->password)) {
      $this->hashed_password = User::hashPassword($this->password);
    }
  }
  
  public function beforeCreate() {
    $this->hashed_password = User::hashPassword($this->password);
  }
  
  public static function hashPassword($password) {
    $hsh = $password;
    for($i = 0; $i < 1000000; $i++)
      $hsh = sha1($hsh);
    return $hsh;
  }
}
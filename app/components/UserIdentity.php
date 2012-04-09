<?php

class UserIdentity extends CUserIdentity {
  
  private $_id, $_user;
  
  public function authenticate() {
    $user = new User;
    $user->username = $this->username;
    $user->password = $this->password;
    $this->_user = $user;
    $auth_user = $user->authenticate();
    if($auth_user == null)
      $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
    else {
      $this->_id = $auth_user->id;
      $this->errorCode = self::ERROR_NONE;
    }
    $this->_user->password = '';
    
    return !$this->errorCode;
  }
  
  public function getTemporaryUser() {
    return $this->_user;
  }
  
  public function getId() {
    return $this->_id;
  }
}
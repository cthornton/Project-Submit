<?php
class WebUser extends CWebUser {
  
  private $model;
  protected $_access = array();
  
  public function getUserModel() {
    if(empty($this->id)) return null;
    if($this->model == null)
      $this->model = User::model()->with(array('role' => array('select' => 'id, system_name')))->findByPk($this->id);
    return $this->model;
  }
  
  public function isAdmin() {
    $mdl = $this->getUserModel();
    if($mdl == null) return false;
    return $mdl->role_id == 1;
  }
  
  public function checkAccess($operation, $params=array ( ), $allowCaching=true) {
    // Modify the default system method to pass the role name instead of the user ID
    if($allowCaching && $params===array() && isset($this->_access[$operation]))
      return $this->_access[$operation];
    else {
      $mdl = $this->getUserModel();
      $group = $mdl == null ? 'guest' : $mdl->role->system_name;
      return $this->_access[$operation]=Yii::app()->getAuthManager()->checkAccess($operation,$group,$params);
    }
  }
  
}
<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {
  
  private $_current_user = null;
  
  public function filters() {
    return array('accessControl');
  }
  
  public function requireAccess($operation, array $params = array()) {
    // Allow admin to do whatever he wants
    if(Yii::app()->user->isAdmin())
      return;
    if(!Yii::app()->user->checkAccess($operation, $params))
      throw new CHttpException(403, "You are not allowed to access this page!");
  }
  
  public function user() {
    if($this->isGuest())
      return null;
    if($this->_current_user == null)
      $this->_current_user = Yii::app()->user->getUserModel();
    return $this->_current_user;
  }
  
  public function getUser() {
    return $this->user();
  }
  
  public function flash($key, $message) {
    Yii::app()->user->setFlash($key, $message);
  }
  
  public function isGuest() {
    return Yii::app()->user->isGuest;
  }
  
  public function getIsGuest() {
    return $this->isGuest();
  }
  
  public function isLogged() {
    return !$this->isGuest();
  }
  
  /**
   *
   */
  public function render($view = null, $data = null, $return = false) {
    if(is_array($view)) {
      $data = $view;
      $view = null;
    }
    if($view == null) {
      $called = debug_backtrace();
      $tmp = Inflector::underscore($called[1]['function']);
      $view = substr($tmp, 7);
    }
    return parent::render($view, $data, $return);
  }
  
  public function isPost() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }
  public function getIsPost() {
    return $this->isPost();
  }
  
  
  public function page_title($text) {
    $this->pageTitle = $text . " | " . Yii::app()->name;
    return '<h2>' . $text . '</h2>';
  }
  
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='two_column';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}
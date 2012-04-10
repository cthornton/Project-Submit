<?php

class UsersController extends Controller {
  
  
  public $layout = 'one_column';
  
  public function accessRules() {
    return array(
      array('allow', 'actions' => array('index'), 'roles' => array('admin')),
      array('allow', 'actions' => array('new', 'login'), 'users' => array('?')),
      array('allow', 'actions' => array('logout', 'view', 'edit'), 'users' => array('@')),
      
      // Default to deny all other actions
      array('deny', 'users' => array('*')),
    );
  }
  
  /**
   * Views all users. Only available as admin
   */
  public function actionIndex() {
    $users = new CActiveDataProvider('User', array(
        'criteria' => array(
          'with' => 'role'
        ),
      ));
    $this->render(array('users' => $users));
  }
  
  /**
   * Creates a new user
   */
  public function actionNew() {
    $user = new User('register');
    if($this->isPost()) {
      $user->setAttributes($_POST['User']);

      $user->role_id = $_POST['User']['role_id'];
      if($user->save()) {
        $this->flash("success", "Your user account has been created");
        return $this->redirect(array('users/login'));
      }
      $user->password = '';
      $user->password_confirmation = '';
    }
    $this->render(array('user' => $user));
  }
  
  /**
   * Edits an existing user
   */
  public function actionEdit() {
    $user = User::model()->findByPk($_GET['id']);
    if($this->isPost()) {
      $user->setAttributes($_POST['User']);
      if($user->save()) {
        $this->flash('success', 'User profile has been saved');
        return $this->redirect(array('users/view', 'id' => $user->id));
      }
    }
    $user->password = '';
    $this->requireAccess('ownItems', array('user_id' => $user->id));
    $this->render(array('user' => $user));
  }
  
  
  public function actionView() {
    $user = User::model()->findByPk($_GET['id']);
    $this->requireAccess('ownItems', array('user_id' => $user->id));
    $this->render(array('user' => $user));
  }
  

  
  
  public function actionLogout() {
    Yii::app()->user->logout();
    $this->flash("success", "You have been logged out");
    return $this->redirect("/");
  }
  
  public function actionLogin() {
    if($this->isPost()) {
      $identity = new UserIdentity($_POST['User']['username'], $_POST['User']['password']);
      $user = $identity->getTemporaryUser();
      
      if($identity->authenticate()) {
        Yii::app()->user->login($identity);
        $this->flash("success", "Login successful.");
        return $this->redirect(array('users/view', 'id' => $this->user->id));
      }
      
    } else {
      $user = new User;
    }
    $this->render('login', array('user' => $user));
  }
  
}


?>
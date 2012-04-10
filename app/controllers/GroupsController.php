<?php
class GroupsController extends Controller {
  
  public $layout = 'one_column';
  
  public function accessRules() {
    return array(
      array('allow', 'actions' => array('new', 'edit', 'delete'), 'roles' => array('admin', 'professor', 'student')),
      array('allow', 'actions' => array('logout', 'view', 'edit', 'index', 'join'), 'users' => array('@')),
      
      // Default to deny all other actions
      array('deny', 'users' => array('*')),
    );
  }
  
  public function actionJoin() {
    if($this->isPost()) {
      $group = Group::model()->findByPk($_GET['id']);
      $user  = User::model()->findByPk($_GET['user_id']);
      $this->requireAccess('ownItems', array('user_id' => $user->id));
      if($group->inGroup($user)) {
        $this->flash('alert', "User is already part of this group");
      } else {
        $group->addUser($user);
        $this->flash('success', 'User added successfully to group');
      }
      $this->redirect(array('groups/view', 'id' => $group->id));
    }
  }
  
  
  /**
   * @todo validate if the current user should be able to view this
   */
  public function actionView() {
    $group = Group::model()->findByPk($_GET['id']);
    $students = new CActiveDataProvider('User', array(
      'criteria' => array(
        'with' => 'groups',
        'condition' => 'groups.id = ' . $group->id,
        'order'    => 't.last_name',
        'together' => true
      ),
      'pagination' => array('pageSize' => 20),
    ));
    $this->render(array('group' => $group, 'students' => $students));
  }
  
  public function actionNew() {
    $course = Course::model()->findByPk($_GET['course_id']);
    $group = new Group;
    $group->course_id = $course->id;
    if(isset($_POST['Group'])) {
      $group->setAttributes($_POST['Group']);
      if($group->save()) {
        $this->flash('success', 'Group has successfully been created');
        return $this->redirect(array('groups/view', 'id' => $group->id));
      }
    }
    $this->render(array('group' => $group, 'course' => $course));
  }
  
}
  
?>
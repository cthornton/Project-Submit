<?php
class GroupsController extends Controller {
  
  public $layout = 'one_column';
  
  public function accessRules() {
    return array(
      array('allow', 'actions' => array('new', 'edit', 'delete'), 'roles' => array('admin', 'professor', 'student')),
      array('allow', 'actions' => array('logout', 'view', 'edit', 'index'), 'users' => array('@')),
      
      // Default to deny all other actions
      array('deny', 'users' => array('*')),
    );
  }
  
  /**
   * @todo validate if the current user should be able to view this
   */
  public function actionView() {
    $group = Group::model()->findByPk($_GET['id']);
    $this->render(array('group' => $group));
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
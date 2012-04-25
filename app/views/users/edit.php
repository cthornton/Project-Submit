<?php
  $this->breadcrumbs = array(
    $this->user->fullName => array('users/view', 'id' => $user->id),
  ); 
  echo $this->page_title('Edit User');
?>
<?php echo $this->renderPartial('_form', array('user' => $user)); ?>
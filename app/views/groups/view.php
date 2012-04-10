<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index'),
    $group->course->name => array('courses/view', 'id' => $group->course->id)
  );
  
  echo $this->page_title($group->name, link_to($group->course->name, $group->course));
?>


<div class="form-actions">
  <?php echo link_to('Cancel', $group->course, array('class' => 'btn')); ?>
  <?php echo link_to('Join Group', '#', array('submit' => array('join', 'id' => $group->id, 'user_id' => $this->user->id), 'csrf' => true, 'class' => 'btn btn-primary', 'style' => 'float: right', 'confirm' => 'Are you sure you want to join this group?')); ?>
</div>
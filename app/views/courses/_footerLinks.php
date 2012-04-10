 <?php
if($this->user->id == $course->user_id || $this->user->isAdmin) {  
  echo link_to('Edit Course', array('courses/edit', 'id' => $course->id), array('class' => 'btn'));
} ?>
<?php echo link_to('Cancel', array('courses/index'), array('class' => 'btn')); ?> 
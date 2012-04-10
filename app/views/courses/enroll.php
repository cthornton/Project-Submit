<?php
$this->breadcrumbs = array(
  'Courses' => array('courses/all'),
  'Search Courses' => array('courses/all'),
);

echo $this->page_title('Enroll in Course', $course->name);
?>
<p>
  Are you sure you want to enroll <strong><?php echo $user->fullName; ?></strong> in
  the course <strong><?php echo $course->name; ?>?
</p>
<div class="form-actions">
  <?php echo CHtml::button('Enroll', array('submit' => array('id' => $course->id, 'user' => $user->id), 'class' => 'btn btn-primary', 'csrf' => true)); ?>
  <?php echo link_to('Cancel', array('courses/all'), array('class' => 'btn')); ?>
</div>
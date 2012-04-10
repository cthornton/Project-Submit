<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index'),
    $assignment->course->name => array('courses/view', 'id' => $assignment->course->id),
  );
  echo $this->page_title('New Assignment', $assignment->course->name);
  $this->renderPartial('_form', array('assignment' => $assignment));
?>

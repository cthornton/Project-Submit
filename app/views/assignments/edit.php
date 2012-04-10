<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index'),
    $assignment->course->name => array('courses/view', 'id' => $assignment->course->id),
    $assignment->name => array('assignments/view', 'id' => $assignment->id)
  );
  
  echo $this->page_title('Edit Assignment');
  $this->renderPartial('_form', array('assignment' => $assignment));
?>
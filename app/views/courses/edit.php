<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index'),
    $course->name => array('courses/view', 'id' => $course->id),
  );
  echo $this->page_title("Edit Course");
  echo $this->renderPartial('_form', array('course' => $course));
?>
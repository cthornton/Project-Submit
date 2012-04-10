<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index'),
    $submission->assignment->course->name => array('courses/view', 'id' => $submission->assignment->course->id),
    $submission->assignment->name => array('courses/view', 'id' => $submission->assignment->id)
  );
?>
<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index'),
    $submission->assignment->course->name => array('courses/view', 'id' => $submission->assignment->course->id),
    $submission->assignment->name => array('courses/view', 'id' => $submission->assignment->id)
  );
  
  echo $this->page_title('New Assignment Submission', link_to($submission->assignment->name, $submission->assignment));
  $this->renderPartial('_form', array('submission' => $submission));
?>
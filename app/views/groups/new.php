<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index'),
    $course->name => array('courses/view', 'id' => $course->id)
  );
  
  echo $this->page_title('New Group');
  $this->renderPartial('_form', array('group' => $group, 'course' => $course));
  
?>
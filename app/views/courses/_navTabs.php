<?php
$this->breadcrumbs = array('Courses' => array('courses/index'));

echo $this->page_title($course->name, $course->instructor->fullName);

$this->widget('zii.widgets.CMenu', array(
  'htmlOptions' => array('class' => 'nav nav-tabs'),
  'items'=>array(
    array('label' => 'Assignments', 'url' => array('courses/view', 'id' => $course->id)),
    array('label' => 'Students', 'url' => array('courses/students', 'id' => $course->id)),
    array('label' => 'Groups', 'url' => array('courses/groups', 'id' => $course->id)),
    array('label' => 'Info', 'url' => array('courses/description', 'id' => $course->id)),
  ),
));
?>
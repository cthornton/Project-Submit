<?php
$this->breadcrumbs = array(
  'Courses' => array('courses/index'),
  $group->course->name => array('courses/view', 'id' => $group->course->id)
);
echo $this->page_title($group->name, link_to($group->course->name, $group->course));

$this->widget('zii.widgets.CMenu', array(
  'htmlOptions' => array('class' => 'nav nav-tabs'),
  'items'=>array(
    array('label' => 'Submissions', 'url' => array('groups/view', 'id' => $group->id)),
    array('label' => 'Team Members', 'url' => array('groups/students', 'id' => $group->id)),
  ),
));
?>
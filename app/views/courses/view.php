<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index')
  );
  echo $this->page_title($course->name, link_to($course->instructor->fullName, $course->instructor));
?>
<p><?php echo htmlentities($course->description); ?></p>
<h3>Assignments</h3>
<p>
  This course has the following assignments:
</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
  'dataProvider' => $assignments,
  'itemsCssClass' => 'table table-striped table-bordered',
  'filterPosition' => 'footer',
  'summaryText' => '',
  'columns' => array(
    array(
      'name' => 'name',
      'type' => 'raw',
      'value' => 'link_to($data->name, $data)'
    ),
    array(
      'name' => 'due_at',
      'value' => '$data->timestampize("due_at", HUMAN_TIMESTAMP)'
    ),
    array(
      'name' => 'submit',
      'value' => 'link_to("Submit", array("submissions/new", "assignment_id" => $data->id), array("class" => "btn btn-mini"))',
      'type' => 'raw'
    )
  )
));
?>

<h3>Groups</h3>
<p>The following groups are part of this course:</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
  'dataProvider' => $groups,
  'itemsCssClass' => 'table table-striped table-bordered',
  'filterPosition' => 'footer',
  'summaryText' => '',
  'columns' => array(
    array(
      'name' => 'name',
      'type' => 'raw',
      'value' => 'link_to($data->name, $data)'
    ),
    array(
      'name' => '# Students',
      'value' => '$data->studentCount'
    ),
  )
));
?>
<p style="text-align:right">
<?php echo link_to('Create Group', array('groups/new', 'course_id' => $course->id), array('class' => 'btn')); ?>
</p>

<div class="form-actions">
<?php if($this->user->id == $course->user_id) {
  echo link_to('Create Assignment', array('assignments/new', 'course_id' => $course->id), array('class' => 'btn btn-primary')) . ' ';
  echo link_to('Edit Course', array('courses/edit', 'id' => $course->id), array('class' => 'btn'));
} ?>
</div>

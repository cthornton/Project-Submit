<?php $this->renderPartial('_navTabs', array('course' => $course)); ?>
<p>All assignments for this course</p>
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
    'description',
    array(
      'name' => 'due_at',
      'value' => '$data->timestampize("due_at", HUMAN_TIMESTAMP)'
    ),
    array(
      'name' => 'submit',
      'value' => 'link_to("<i class=\"icon-upload\"></i> Submit", array("submissions/new", "assignment_id" => $data->id), array("class" => "btn btn-mini"))',
      'type' => 'raw'
    )
  )
));
?>


<div class="form-actions">
  <?php
    if($this->user->id == $course->user_id || $this->user->isAdmin)
      echo link_to('Create Assignment', array('assignments/new', 'course_id' => $course->id), array('class' => 'btn btn-primary')) . ' ';
    $this->renderPartial('_footerLinks', array('course' => $course));
  ?>
</div>

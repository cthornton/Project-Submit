<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index'),
    $assignment->course->name => array('courses/view', 'id' => $assignment->course->id),
  );
  echo $this->page_title($assignment->name, 'Due ' . $assignment->timestampize('due_at', HUMAN_TIMESTAMP));
?>
<p>
  <?php echo nl2br(htmlentities($assignment->description), false); ?>
</p>
<h3 style="margin-top:15px">Submissions</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
  'dataProvider' => $submissions,
  'summaryText' => '',
  'itemsCssClass' => 'table table-striped table-bordered',
  'columns' => array(
    array(
      'name' => 'Group Name',
      'value' => 'link_to($data->group->name, $data->group)',
      'type' => 'raw',
    ),
    array(
      'name' => 'Submitted By',
      'value' => '$data->user->fullName'
    ),
    array(
      'name' => 'Submitted At',
      'value' => '$data->timestampize("submitted_at", US_TIMESTAMP)'
    ),
    array(
      'name' => 'Status',
      'value' => '$data->isLate ? \'<span class="badge badge-error" title="This was submitted past the deadline">Late</span>\' : \'<span class="badge badge-success" title="This was submitted before the deadline">On Time</span>\'',
      'type' => 'raw'
    ),
    array(
      'name' => 'View',
      'value' => 'link_to("More Details", $data, array("class" => "btn btn-mini"))',
      'type' => 'raw',
    ),
    array(
      'name' => 'File',
      'value' => 'empty($data->file_name) ? "<em>None</em>" : link_to("<i class=\"icon-download\"></i> Download", array("submissions/download", "id" => $data->id), array("class" => "btn btn-mini", "title" => $data->file_name, "target" => "_blank"))',
      'type' => 'raw',
    )
  )
));
?>

<div class="form-actions">
<?php
  if($this->user->isProfessor || $this->user->isAdmin) {
    echo link_to('Edit', array('assignments/edit', 'id' => $assignment->id), array('class' => 'btn btn-primary'));
    echo link_to('Delete', '#', array('submit' => array('delete', 'id' => $assignment->id), 'confirm' => 'Are you sure you want to delete this post?', 'csrf' => true, 'class' => 'btn btn-danger', 'style' => 'float:right'));
  }
  echo link_to('Cancel', $assignment->course, array('class' => 'btn'));
?>
</div>
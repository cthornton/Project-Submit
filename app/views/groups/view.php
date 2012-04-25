<?php $this->renderPartial('_nav', array('group' => $group)); ?>
<p>
  This is a record of the submissions made by your group.
</p>
<?php
  $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $submissions,
    'itemsCssClass' => 'table table-striped  table-bordered',
    'columns' => array(
      array(
        'name' => 'Assignment',
        'value' => 'link_to($data->assignment->name, $data->assignment)',
        'type' => 'raw',
      ),
      array(
        'name' => 'Submitted By',
        'value' => '$data->user->fullName',
      ),
      array(
        'name' => 'Submitted At',
        'value' => '$data->timestampize("submitted_at", US_TIMESTAMP)'
      ),
      array(
        'name' => 'Status',
        'value' => '$data->isLate ? \'<span class="badge badge-error" title="This was submitted past the deadline">Late</span>\' : \'<span class="badge badge-success" title="This was submitted before the deadline">On Time</span>\'',
        'type' => 'raw',
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
  <?php echo link_to('Cancel', $group->course, array('class' => 'btn')); ?>
  
  <?php
  if(!$group->inGroup($this->user))
    echo link_to('Join Group', '#', array('submit' => array('join', 'id' => $group->id, 'user_id' => $this->user->id), 'csrf' => true, 'class' => 'btn btn-primary', 'style' => 'float: right', 'confirm' => 'Are you sure you want to join this group?')); ?>
</div>
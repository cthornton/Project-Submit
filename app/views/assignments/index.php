<?php
echo $this->page_title('My Assignments');
?>
<p>You have the following assignments:</p>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
  'dataProvider' => $assignments,
  'itemsCssClass' => 'table table-striped',
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
      'value' => 'link_to("Submit", array("submissions/new", "assignment_id" => $data->id), array("class" => "btn btn-mini"))',
      'type' => 'raw'
    ),
  )
));

?>
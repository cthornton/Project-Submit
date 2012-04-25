<?php $this->renderPartial('_navTabs', array('course' => $course)); ?>
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
    array(
      'name' => 'Join',
      'value' => '$data->inGroup(Yii::app()->user->userModel) ? "Joined" : link_to("Join Group", "#", array("submit" => array("groups/join", "id" => "$data->id", "user_id" => Yii::app()->user->id), "csrf" => true, "class" => "btn btn-mini", "confirm" => "Are you sure you want to join this group?"))',
      'type' => 'raw'
    ),
  )
));
?>
<div class="form-actions">
  <?php
    echo link_to('Create Group', array('groups/new', 'course_id' => $course->id), array('class' => 'btn btn-primary'));
    $this->renderPartial('_footerLinks', array('course' => $course));
  ?>
</div>
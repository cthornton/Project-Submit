<?php
  $this->breadcrumbs = array();
  echo $this->page_title('All Available Courses');
  $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $courses,
    'itemsCssClass' => 'table table-striped',
    'columns' => array(
      'name',
      'description',
      array(
        'name' => 'instructor',
        'value' => '$data->instructor->fullName',
      ),
      array(
        'name' => '# Enrolled',
        'value' => 'count($data->students)'
      ),
      'open:boolean',
      array(
        'name' => 'Enroll',
        'value' => '$data->isEnrolled((int) Yii::app()->user->id) ? "Enrolled" : link_to("Enroll", array("courses/enroll", "id" => $data->id, "user_id" => Yii::app()->user->id), array("class" => "btn btn-mini"))',
        'type' => 'raw'
      ),
    )
  ));
?>
<div class="form-actions">
  <?php echo link_to('Cancel', array('courses/index'), array('class' => 'btn')); ?>
</div>

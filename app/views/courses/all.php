<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index'),
  );
  echo $this->page_title('All Available Courses');
?>
<p>These are all of the courses available for you to enroll in.</p>

<?php  
  $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $courses,
    'itemsCssClass' => 'table table-striped  table-bordered',
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
  <?php echo link_to('My Enrolled Courses', array('courses/index'), array('class' => 'btn')); ?>
</div>

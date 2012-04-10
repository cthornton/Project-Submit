<?php
  $this->breadcrumbs = array();
  echo $this->page_title('My Courses');
  $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $courses,
    'itemsCssClass' => 'table table-striped',
    'columns' => array(
      array(
        'name' => 'name',
        'type' => 'raw',
        'value' => 'link_to($data->name, $data)'
      ),
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
    )
  ));
?>
<div class="form-actions">
  <?php echo link_to('<i class="icon-search"></i> Search Courses', array('courses/all'), array('class' => 'btn')); ?>
</div>

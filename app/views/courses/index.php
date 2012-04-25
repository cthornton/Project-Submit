<?php
  echo $this->page_title('My Courses');
?>
<p>
  These are all of the courses you are enrolled in. Use the <?php echo link_to('search courses', array('courses/all')); ?>
  feature to search for courses.
</p>

<?php  
  $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $courses,
    'itemsCssClass' => 'table table-striped table-bordered',
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
  <?php if($this->user->isProfessor || $this->user->isAdmin) echo link_to('Create Course', array('courses/new'), array('class' => 'btn btn-primary')); ?>
  <?php echo link_to('<i class="icon-search"></i> Search Courses', array('courses/all'), array('class' => 'btn')); ?>
</div>

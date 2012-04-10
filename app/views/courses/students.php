<?php $this->renderPartial('_navTabs', array('course' => $course)); ?>
<p>The following students are enrolled in this course:</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
  'dataProvider' => $students,
  'itemsCssClass' => 'table table-striped table-bordered',
  'filterPosition' => 'footer',
  'summaryText' => '',
  'columns' => array(
    'first_name',
    'last_name',
    'email',
    'phone'
  )
));
?>
<div class="form-actions">
  <?php $this->renderPartial('_footerLinks', array('course' => $course)); ?>
</div>
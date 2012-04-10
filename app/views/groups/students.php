<?php $this->renderPartial('_nav', array('group' => $group)); ?>
<p>This is the contact information of the people in your group.</p>
<?php
  $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $students,
    'itemsCssClass' => 'table table-striped  table-bordered',
    'columns' => array(
      'first_name',
      'last_name',
      'email',
      'phone',
    )
  ));
?>


<div class="form-actions">
  <?php echo link_to('Cancel', $group->course, array('class' => 'btn')); ?>
  
  <div style="float:right">
  <?php
  if(!$group->inGroup($this->user))
    echo ' ' .link_to('Join Group', '#', array('submit' => array('join', 'id' => $group->id, 'user_id' => $this->user->id), 'csrf' => true, 'class' => 'btn btn-primary', 'confirm' => 'Are you sure you want to join this group?'));
  echo ' ' . link_to('Edit my Info', array('users/edit', 'id' => $this->user->id), array('class' => 'btn btn-primary')) . ' ';  
  ?>
  </div>
</div>
<p style="text-align:right">
  <?php  ?>
</p>
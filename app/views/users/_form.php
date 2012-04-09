<?php echo form_for($user, function($f) use($user) { ?>
<div class="form">
  <h3>Account Information</h3>
  
  <div class="item item-inline">
    <?php
      echo $f->label('username');
      echo $f->textField('username');
    ?>
  </div>
  
  <div class="item item-inline">
    <?php echo $f->label('email'). $f->textField('email'); ?>
  </div>
  
  
  <div class="item item-inline">
    <?php
      echo $f->label('password');
      echo $f->passwordField('password');
    ?>
  </div>
  
  <div class="item item-inline">
    <?php
      echo $f->label('password_confirmation');
      echo $f->passwordField('password_confirmation');
    ?>
  </div>
  
  <?php if($user->isNewRecord) { ?>
  <div class="item">
    <?php echo $f->label('role'); ?>
    <?php echo $f->dropDownList('role', array(2 => 'Professor', 3 => 'Student')); ?>
  </div>
  <?php } else { ?>
  <div class="item">
    <strong><?php echo $user->role->name; ?></strong>
  </div>
  <?php } ?>
  
  <h3>Personal Information</h3>
  <div class="item item-inline">
    <?php echo $f->textFieldLabel('first_name'); ?>
  </div>
  <div class="item item-inline">
    <?php echo $f->textFieldLabel('last_name'); ?>
  </div>
  <div class="item item-inline">
    <?php echo $f->textFieldLabel('phone'); ?>
  </div>
  

  

  

</div>

<div class="form-actions">
  <?php echo $f->submit(null, array('class' => 'btn btn-primary')); ?>
  <?php
    if($user->isNewRecord)
      echo link_to('Back', '/', array('class' => 'btn'));
    else
      echo link_to('Back', $user, array('class' => 'btn'));
  ?>
</div>
  
<?php }); ?>
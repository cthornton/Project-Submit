<?php
  echo $this->page_title('Log In');
  echo form_for($user, function($f) { ?>
<div class="form">
  <div class="item">
    <?php
      echo $f->label('username');
      echo $f->textField('username');
    ?>
  </div>
  
  <div class="item">
    <?php
      echo $f->label('password');
      echo $f->passwordField('password');
    ?>
  </div>
</div>

  <div class="form-actions">
    <?php echo $f->submit('Log in', array('class' => 'btn btn-primary')); ?>
    <?php echo link_to('Cancel', '/', array('class' => 'btn')); ?>
  </div>

<?php }); ?>

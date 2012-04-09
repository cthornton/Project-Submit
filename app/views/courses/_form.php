<?php
  $th = $this;
  echo form_for($course, function($f) use($course,$th) { ?>
<div class="form">
  <div class="item"><?php echo  $f->textFieldLabel('name'); ?></div>
  <div class="item"><?php echo  $f->textAreaLabel('description'); ?></div>
  <div class="item"><?php echo $f->checkBox('open') . ' '. $f->label('open', array('style' => 'display:inline')); ?></div>
</div>
<div class="form-actions">
  <?php echo $f->submit(null, array('class' => 'btn btn-primary')); ?>
  <?php
    if($course->isNewRecord)
      echo link_to('Back', $th->user, array('class' => 'btn'));
    else
      echo link_to('Back', $course, array('class' => 'btn'));
  ?>
</div>
<?php }) ?>

<?php
$ths = $this;
echo form_for($assignment, function($f) use($assignment, $ths) { ?>
  <div class="form">
    <div class="item"><?php echo $f->textFieldLabel('name'); ?></div>
    <div class="item"><?php echo $f->textFieldLabel('max_points'); ?></div>
    <div class="item"><?php echo $f->textAreaLabel('description'); ?></div>
    <div class="item">
    <?php
      echo $f->label('due_at');
      Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
      $ths->widget('CJuiDateTimePicker',array(
        'model'=> $assignment, //Model object
        'attribute'=>'due_at', //attribute name
        'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array(
          'ampm' => true,
          //'timeFormat' => 'hh:mm tt'
        ), // jquery plugin options
        'language' => ''
    )); ?>
    </div>
  </div>
  <div class="form-actions">
    <?php echo $f->submit(null, array('class' => 'btn btn-primary')); ?>
    <?php
      if($assignment->isNewRecord)
        echo link_to('Cancel', $assignment->course, array('class' => 'btn'));
      else {
        echo link_to('Cancel', $assignment, array('class' => 'btn'));
      }
    ?>
  </div>
  
<?php }); ?>
<?php
echo form_for($group, function($f) use ($course, $group) {
  echo '<div class="form">';
  echo '<div class="item">' . $f->textFieldLabel('name') . '</div>';
  echo '</div><div class="form-actions">' . $f->submit(null, array('class' => 'btn btn-primary')) . ' ';
  if($group->isNewRecord)
    echo link_to('Cancel', $course, array('class' => 'btn'));
  else
    echo link_to('Cancel', $group, array('class' => 'btn'));
  echo '</div>';
});
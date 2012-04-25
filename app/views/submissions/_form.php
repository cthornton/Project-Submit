<?php echo form_for($submission, function($f) use($submission) {
  echo '<div class="form">';
  echo '<div class="item">' . $f->textFieldLabel('title') . '</div>';
  
  $g = Group::model()->with(array(
    'students',// => array('conditions' => 'students.aid = ' . $submission->user->id),
    'course'   //=> array('conditions' => 'course.id = ' .   $submission->assignment->course->id)
    ))->findAll('students.id = ? AND course.id = ?', array($submission->user->id, $submission->assignment->course->id));
  
  $groups =  array();
  foreach($g as $group) {
    $groups[$group->id] = $group->name;
  }
  
  echo '<div class="item">' . $f->dropDownListLabel('group', $groups) . '</div>';
  echo '<div class="item">' . $f->textAreaLabel('comments') . '</div>';
  echo '<div class="item">' . $f->fileFieldLabel('attachment') . '</div>';
  
  echo '</div><div class="form-actions">';
  echo $f->submit(null, array('class' => 'btn btn-primary')) . ' ' . link_to('Cancel', $submission->assignment, array('class' => 'btn'));
  echo '</div>';
}, array('enctype' => 'multipart/form-data')) ?>
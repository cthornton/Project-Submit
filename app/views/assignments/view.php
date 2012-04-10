<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index'),
    $assignment->course->name => array('courses/view', 'id' => $assignment->course->id),
  );
  echo $this->page_title($assignment->name, 'Due ' . $assignment->timestampize('due_at', HUMAN_TIMESTAMP));
?>
<p>
  <?php echo nl2br(htmlentities($assignment->description), false); ?>
</p>
<h3>Submissions</h3>
<p>
  You have not made any submissions.
</p>

<div class="form-actions">
<?php
  echo link_to('Edit', array('assignments/edit', 'id' => $assignment->id), array('class' => 'btn btn-primary'));
  echo link_to('Delete', '#', array('submit' => array('delete', 'id' => $assignment->id), 'confirm' => 'Are you sure you want to delete this post?', 'csrf' => true, 'class' => 'btn btn-danger', 'style' => 'float:right'));
?>
</div>
<?php
  $this->breadcrumbs = array(
    'Courses' => array('courses/index'),
    $submission->assignment->course->name => array('courses/view', 'id' => $submission->assignment->course->id),
    $submission->assignment->name => array('courses/view', 'id' => $submission->assignment->id)
  );

  echo $this->page_title('View Submission' . ($submission->isLate ? ' (Late)' : ''), $submission->group->name);
?>


<h3>Submission Details <?php if($submission->isLate) { ?> <span class="label label-important">Late</span> <?php } else { ?> <span class="label label-success">On Time</span> <?php } ?></h3>
<p>
  <b>Title: </b> <?php echo empty($submission->title) ? '<em>none</em>' : htmlentities($submission->title); ?> <br>
  <b>Submitted At: </b> <?php echo $submission->timestampize('submitted_at', US_TIMESTAMP); ?><br>
  <?php if(!empty($submission->file_name)) { ?>
    <b>Attachment:</b> <?php echo link_to($submission->file_name, array('submissions/download', 'id' => $submission->id)); ?>
  <?php } ?>
  <?php if(!empty($submission->comments)) { ?>
    <b>Comments: </b><br>
    <?php echo nl2br(htmlentities($submission->comments)); ?>
    <br>
  <?php } ?>

</p>

<hr>

<h3>Assignment Details</h3>
<p>
  <b>Name: </b> <?php echo link_to($submission->assignment->name, $submission->assignment); ?><br>
  <b>Due At: </b> <?php echo $submission->assignment->timestampize('due_at', US_TIMESTAMP); ?>
</p>

<div class="form-actions">
  <?php echo link_to('Cancel', $submission->assignment, array('class' => 'btn')); ?>
</div>
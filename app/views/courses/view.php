<?php echo $this->page_title($course->name); ?>
<p>
  <em>Instructor: <?php echo link_to($course->instructor->fullName, $course->instructor); ?></em>
</p>
<p>
  <?php echo htmlentities($course->description); ?>
</p>
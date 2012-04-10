<?php $this->renderPartial('_navTabs', array('course' => $course)); ?>
<p>
  Some information about this course:
<p>
<table class="table table-bordered">
  <tr>
    <th style="width:150px">Course Name</th>
    <td><?php echo h($course->name); ?></td>
  </tr>
  <tr>
    <th>Course Description</th>
    <td><?php echo nl2br(h($course->description)); ?></td>
  </tr>
  <tr>
    <th>Instructor name</th>
    <td><?php echo h($course->instructor->fullName); ?></td>
  </tr>
  <tr>
    <th>Instructor Email</th>
    <td><?php echo $course->instructor->email; ?></td>
  </tr>
</table>
</p>
<div class="form-actions">
  <?php $this->renderPartial('_footerLinks', array('course' => $course)); ?>
</div>
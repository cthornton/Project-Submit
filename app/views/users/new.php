<?php echo $this->page_title('Create Account', 'your adventure begins here'); ?>
<p>
  Fill out the following form to create a new user account
</p>
<?php echo $this->renderPartial('_form', array('user' => $user)); ?>

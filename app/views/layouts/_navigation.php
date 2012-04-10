<?php $this->widget('zii.widgets.CMenu', array(
  'items' => array(
    array('label' => 'Home', 'url' => array('welcome/index')),
    array('label' => 'Register', 'url' => array('users/new'), 'visible' => $this->isGuest()),
    
    array('label' => 'Courses', 'url' => array('courses/index'), 'visible' => !$this->isGuest),
    array('label' => 'Assignments', 'url' => array('assignments/index'), 'visible' => !$this->isGuest),
    
    array('label' => 'Login', 'url' => array('users/login'), 'visible' => $this->isGuest()),
    
    array('label' => 'Logout', 'url' => array('users/logout'), 'visible' => !$this->isGuest())
  )
)); ?>
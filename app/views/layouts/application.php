<?php

// Always require jquery
Yii::app()->clientScript->registerCoreScript('jquery');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-2" />
  <?php
    echo stylesheet_tag('form.css');
    echo stylesheet_tag('bootstrap.min.css');
    echo stylesheet_tag('bootstrap-responsive.min.css');
    
    echo stylesheet_tag('style.css');
    echo stylesheet_tag('layout.css');
    

  ?>
  
	<title><?php echo h($this->pageTitle); ?></title>
  <?php
    echo javascript_include_tag('application.js');
    echo javascript_include_tag('bootstrap.min.js');
  ?>
</head>
<body>
	<div class="content">
		<div class="header_right">
			<div class="top_info">
				<div class="top_info_right">
        <?php if($this->isGuest()) { ?> 
					<p><?php echo link_to("Log in", array('users/login')); ?>  or <?php echo link_to ('register', array('users/new')); ?> to begin!</p>					
        <?php } else { ?>
          <p>
            <span style="margin-right:15px">Welcome, <b><?php echo $this->user->fullName; ?></b>!</span>
            <?php echo link_to("My Profile", $this->user()); ?> &bull;
            <?php echo link_to("Logout", array('users/logout')); ?>
          </p>
        <?php } ?>
				</div>		
			</div>
					
			<div class="bar">
        <?php $this->renderPartial('/layouts/_navigation'); ?>
			</div>
		</div>
			
		<div class="logo">
			<h1><a href="/">Project <span class="red">Submit</span></a></h1>
			<p>Submit your group project</p>
		</div>
		
    
		
		<div class="subheader">
      <?php
        $this->widget('zii.widgets.CBreadcrumbs', array(
          'links'=>$this->breadcrumbs,
        ));
      ?>
		</div>
		
    <?php
      $flashes = Yii::app()->user->getFlashes();
      if(count($flashes) != 0) {
        echo '<div id="flashes">';
        foreach($flashes as $key => $message)
            echo '<div class="alert alert-' . $key . '"><a class="close" data-dismiss="alert" href="#">x</a>' . $message . "</div>\n";
        echo '</div>';
      }
      
      echo $content;
      
    ?>

		<div class="footer">
			<p><a href="#">RSS Feed</a> | <a href="#">Contact</a> | <a href="#">Accessibility</a> | <a href="#">Products</a> | <a href="#">Disclaimer</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a><br />
			&copy; Copyright 2006 Internet Music, Design: Luka Cvrk, <a title="Awsome Web Templates" href="http://www.solucija.com/">Solucija</a></p>
		</div>
	</div>
</body>
</html>
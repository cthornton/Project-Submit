    
    <?php if($this->isGuest) { ?>
      <div class="rt"></div>
      <div class="right_articles">
        <p>
          <b>Welcome to Project Submit</b>
        </p>
        <p>
          Project Submit allows you to join a group for a class project.
          Please <?php echo link_to('Sign Up', array('users/new')); ?>
          or <?php echo link_to('Log In', array('users/login')); ?> to begin.
        </p>
      </div>
    <?php } else { ?>
      <div class="rt"></div>
      <div class="right_articles">
        <p><b>My Courses</b></p>
      </div>
      
      
    <?php } ?>
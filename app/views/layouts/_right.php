    
    <?php if($this->isGuest) { ?>
      <div class="rt"></div>
      <div class="right_articles">
        <p>
          <b>Welcome to Project Submit</b>
        </p>
        <p>
          Project Submit allows you to join a group for a class project.
        </p>
        <p>
          <?php echo link_to('Sign Up', array('users/new')); ?> |
          <?php echo link_to('Log In', array('users/login')); ?>
        </p>
      </div>
    <?php } else { ?>
    
    <?php } ?>

  <div style="float:right">
    <?php echo link_to('Edit Profile', array('users/edit', 'id' => $user->id)); ?>
  </div>
  <?php echo $this->page_title($user->fullName); ?>
  <p><em><?php echo $user->role->name ?></em></p>
</div>
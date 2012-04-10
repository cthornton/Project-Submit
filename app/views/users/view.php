
  <?php echo $this->page_title($user->fullName, $user->role->name); ?>
  
  <table style="width:50%" class="table table-bordered">
    <tr>
      <th style="width:100px">Username</th>
      <td><?php echo h($user->username); ?></td>
    </tr>
    <tr>
      <th>First Name</th>
      <td><?php echo h($user->first_name); ?></td>
    </tr>
    <tr>
      <th>Last Name</th>
      <td><?php echo h($user->last_name); ?></td>
    </tr>
    <tr>
      <th>Email</th>
      <td><?php echo h($user->email); ?></td>
    </tr>
    <tr>
      <th>Phone</th>
      <td><?php echo h($user->phone); ?></td>
    </tr>
  </table>
  
  <div class="form-actions">
    <?php echo link_to('Edit Profile', array('users/edit', 'id' => $user->id), array('class' => 'btn btn-primary')); ?>
    <?php echo link_to('Cancel', array('welcome/index'), array('class' => 'btn')); ?>
  </div>
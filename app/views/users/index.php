<?php echo $this->page_title('View All Users'); ?>
<p>
  Below are all users registered with Project Submit.
</p>
<?php  
  $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $users,
    'itemsCssClass' => 'table table-striped table-bordered users-table',
    'columns' => array(
      'username',
      array(
        'name' => 'role',
        'value' => '$data->role->name',
      ),
      'first_name',
      'last_name',
      'email',
      'phone',
      array(
        'name' => 'view',
        'value' => 'link_to("View Profile", $data, array("class" => "btn btn-mini"))',
        'type' => 'raw'
      ),
      
    )
  ));
?>
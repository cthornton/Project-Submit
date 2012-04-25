<?php

class m120410_095051_create_admin_user extends Migration
{
	public function up()
	{
    
    $user = new User;
    $user->username   = 'admin';
    $user->password   = '1111qqqq';
    $user->password_confirmation = '1111qqqq';
    $user->email      = 'admin@example.com';
    $user->first_name = 'Admin';
    $user->last_name  = 'Account';
    $user->role_id    = 1;
    $user->validated = true;
    
    
    if(!$user->save()) {
      echo "Unable to save user\n";
      var_dump($user->getErrors());
      return false;
    }
	}

	public function down()
	{
		echo "m120410_095051_create_admin_user does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
<?php

class m120425_232929_seed_user_account extends CDbMigration
{
	public function up()
	{
		// Make sure the admin account doesn't exist
		$findAdmin = User::model()->where('username = "admin"')->findAll();
		var_dump($findAdmin);
		if(count($findAdmin) == 0 ) {
		
			echo "Creating Admin account...";
			$user = new User;
			$user->username = 'admin';
			$user->password = '1111qqqq';
			$user->password_confirmation = '1111qqqq';
			$user->email    = 'admin@example.com';
			$user->validated = true;
			$user->first_name = 'Admin';
			$user->last_name = 'Account';
			$user->role_id = 1;
			if(!$user->save()) {
				echo "Error with migration!\n";
				var_dump($user->errors);
				return false;
			}
		} else {
			echo "Admin account already exists; not creating admin user";
		}
	}

	public function down()
	{
		//echo "m120425_232929_seed_user_account does not support migration down.\n";
		return true;
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
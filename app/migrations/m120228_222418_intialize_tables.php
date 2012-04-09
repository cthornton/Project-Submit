<?php

class m120228_222418_intialize_tables extends Migration {
	public function safeUp(){
    
    $this->createTable('users', array(
      'id'  => 'pk',
      'username' => 'string NOT NULL',
      'hashed_password' => 'string NOT NULL',
      'email'    => 'string NOT NULL',
      'validated' => 'boolean default 0',
      'created_at' => 'datetime',
      'updated_at' => 'datetime'
    ));
    
    $user = new User;
    $user->username = 'admin';
    $user->password = '1111qqqq';
    $user->email    = 'admin@example.com';
    $user->validated = true;
    if(!$user->save()) {
      echo "Unable to save user\n";
      var_dump($user->getErrors());
      $this->dropTable('users');
      return false;
    }
	}

	public function safeDown() {
    $this->dropTable('users');
  }
}
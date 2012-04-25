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
    
    

	}

	public function safeDown() {
    $this->dropTable('users');
  }
}
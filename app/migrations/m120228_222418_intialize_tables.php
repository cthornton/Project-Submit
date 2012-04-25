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
    
<<<<<<< HEAD
    
=======
>>>>>>> 61d0a9dbbd2a05eb0c2fe819248389d80a6d730e

	}

	public function safeDown() {
    $this->dropTable('users');
  }
}
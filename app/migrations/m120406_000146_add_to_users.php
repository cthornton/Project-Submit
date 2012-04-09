<?php

class m120406_000146_add_to_users extends Migration
{
	public function up()
	{
    $this->addColumn('users', 'first_name', 'string');
    $this->addColumn('users', 'last_name', 'string');
    $this->addColumn('users', 'phone', 'string');
	}

	public function down()
	{
		echo "m120406_000146_add_to_users does not support migration down.\n";
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
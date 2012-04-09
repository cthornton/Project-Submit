<?php

class m120404_012110_make_roles_and_such extends Migration
{

	public function safeUp()
	{
    
    $this->createTable('roles', array(
      'id' => 'pk',
      'name' => 'string',
      'description' => 'string',
      'system_name' => 'string'
    )); 
    $this->addColumn('users', 'role_id', 'integer');
    $this->addForeignKey('user_role_id', 'users', 'role_id', 'roles', 'id');
    $this->createIndex('roles_system_name', 'roles', 'system_name', true); 
    
    $role = new Role;
    $role->name = 'Administrator';
    $role->system_name = 'admin';
    $role->description = "The system administrator";
    $role->save();
    
    $role = new Role;
    $role->name = 'Professor';
    $role->system_name = 'professor';
    $role->description = "A professor who can create courses";
    $role->save();
    
    
    $role = new Role;
    $role->name = 'Student';
    $role->system_name = 'student';
    $role->description = "A student who can make submissions";
    $role->save();
    
	}

	public function safeDown()
	{
    $this->dropForeignKey('user_role_id', 'users');
    $this->dropTable('roles');
    $this->dropColumn('users', 'role_id');
	}
}
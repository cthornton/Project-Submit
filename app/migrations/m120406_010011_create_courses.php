<?php

class m120406_010011_create_courses extends Migration
{
	public function up()
	{
    
    $this->createTable('courses', array(
      'id' => 'pk',
      'user_id' => 'integer NOT NULL',
      'name' => 'string NOT NULL',
      'description' => 'text NOT NULL',
      'open' => 'boolean default 1',
      'created_at' => 'datetime',
      'updated_at' => 'datetime'
    ));
    
    $this->addForeignKey('courses_user', 'courses', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    
    $this->createTable('assignments', array(
      'id' => 'pk',
      'course_id' => 'integer NOT NULL',
      'name' => 'string NOT NULL',
      'description' => 'text',
      'due_at' => 'datetime NOT NULL',
      'max_points' => 'integer default 0',
      'created_at' => 'datetime',
      'updated_at' => 'datetime'
    ));
    
    $this->addForeignKey('assignments_course', 'assignments', 'course_id', 'courses', 'id', 'cascade', 'cascade');
    
    $this->createTable('course_groups', array(
      'id' => 'pk',
      'course_id' => 'integer NOT NULL',
      'name' => 'string NOT NULL',
      'created_at' => 'datetime',
      'updated_at' => 'datetime'
    ));
    
    $this->addForeignKey('groups_course', 'course_groups', 'course_id', 'courses', 'id', 'cascade', 'cascade');
    
   
    
    $this->createTable('submissions', array(
      'id' => 'pk',
      'course_group_id' => 'integer NULL',
      'user_id'  => 'integer NULL',
      'assignment_id' => 'integer NOT NULL',
      'title'    => 'string',
      'comments' => 'text',
      'submitted_at' => 'datetime',
      'late'    => 'boolean default 0',
      'graded'  => 'boolean default 0',
      'points'  => 'integer',
      'file_name' => 'string',
      'file_size' => 'integer',
      'file_type' => 'string'
    ));
    
    $this->addForeignKey('submissions_course_group', 'submissions', 'course_group_id', 'course_groups', 'id', 'SET NULL', 'CASCADE');
    $this->addForeignKey('submissions_user', 'submissions', 'user_id', 'users', 'id', 'SET NULL', 'CASCADE');
    $this->addForeignKey('submissions_assignment', 'submissions', 'assignment_id', 'assignments', 'id', 'CASCADE', 'CASCADE');
    
    
    $this->createTable('course_groups_users', array(
      'course_group_id' => 'integer NOT NULL',
      'user_id'         => 'integer NOT NULL'
    ));
    
    $this->addForeignKey('course_groups_users_group', 'course_groups_users', 'course_group_id', 'course_groups', 'id', 'CASCADE', 'CASCADE');
    $this->addForeignKey('course_groups_users_user', 'course_groups_users', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE'); 
    
    $this->createTable('courses_users', array(
      'course_id' => 'integer NOT NULL',
      'user_id'   => 'integer NOT NULL'
    ));
    
    $this->addForeignKey('courses_users_course', 'courses_users', 'course_id', 'courses', 'id', 'CASCADE', 'CASCADE');
    $this->addForeignKey('courses_users_user', 'courses_users', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    
    
	}

	public function down()
	{
		echo "m120406_010011_create_courses does not support migration down.\n";
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
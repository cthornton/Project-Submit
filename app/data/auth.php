<?php
//die(var_dump(Yii::app()->user->getUserModel()));
return array(
  'admin' => array(
    'type' => CAuthItem::TYPE_ROLE,
    'description' => 'The Administrator',
    'bizRule' => '',
    'data' => '',
    'assignments' => array('admin' => array('bizRule' => '', 'data' => '')),
    'children'    => array('ownItems'),
  ),
  
  'professor' => array(
    'type' => CAuthItem::TYPE_ROLE,
    'description' => 'A professor',
    'data' => '',
    'bizRule' => '',
    'assignments' => array('professor' => array('bizRule' => '', 'data' => '')),
    'children'    => array('ownItems', 'createCourse')
  ),
  
  'student' => array(
    'type' => CAuthItem::TYPE_ROLE,
    'description' => 'A student',
    'data' => '',
    'bizRule' => '',
    'assignments' => array('student' => array('bizRule' => '', 'data' => '')),
    'children'    => array('ownItems')
  ),
  
  
  // Allow access to own assets; simply pass a param for user_id
  'ownItems' => array(
    'type' => CAuthItem::TYPE_OPERATION,
    'description' => 'A generic operation that allows somebody to perform their own operations',
    'data' => '',
    'children' => array('ownProfile'),
    'bizRule' => 'return Yii::app()->user->id==$params["user_id"];'
  ),
  
  'createCourse' => array(
    'type' => CAuthItem::TYPE_OPERATION,
    'description' => 'A person who can create a course',
    'data' => '',
    'bizRule' => '',
  )
)


?>
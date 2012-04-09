<?php

class Migration extends CDbMigration {
  
  public function createTable($table, $columns, $options = null) {
    if($options == null) $options = '';
    if(strpos(strtolower($options), 'engine') == -1)
      $options .= 'ENGINE = InnoDB';
    parent::createTable($table, $columns, $options);
  }
}
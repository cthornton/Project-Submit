<?php

abstract class ModelBase extends CActiveRecord {
  
  public function beforeCreate() { }
  public function beforeUpdate() { }
  
  public static function model($className = __CLASS__) {
    return parent::model(get_called_class());
  }
  
  
  /**
   * Automate creation of timestamps
   */
  public function beforeSave() {
    if($this->hasAttribute('created_at') && $this->isNewRecord) 
      $this->created_at = new CDbExpression('NOW()');
    if($this->hasAttribute('updated_at'))
      $this->updated_at = new CDbExpression('NOW()');
    if($this->isNewRecord)
      $this->beforeCreate();
    else
      $this->beforeUpdate();
     
    foreach($this->tableSchema->columns as $col) {
      if($col->dbType == 'datetime' && $col->name != 'created_at' && $col->name != 'updated_at') {
        $attr = $this->getAttribute($col->name);
        if(is_int($attr)) {
          $this->setAttribute($col->name, date(THE_SQL_TIMESTAMP, $attr));
        } elseif(is_string($attr)) {
          $timestamp = CDateTimeParser::parse($attr, APP_TIMESTAMP);
          if($timestamp)
            $this->setAttribute($col->name, date(THE_SQL_TIMESTAMP, $timestamp));
        }
      }
    }
    return parent::beforeSave();
  }
  
  public function timestampize($attribute, $format = null) {
    $ts = CDateTimeParser::parse($this->getAttribute($attribute), APP_SQL_TIMESTAMP);
    if($format == null)
      return $ts;
    else
      return date($format, $ts);
  }
  
  /**
   * Make the default tablename a lower case pluralized version of this classname.
   */
  public function tableName() {
    return Inflector::tableize(get_class($this));
  }
  
  public function findByPk($pk, $condition = '', $params = array()) {
    $model = parent::findByPk($pk, $condition, $params);
    if($model == null)
      throw new CHttpException(404, 'The requested resource was not found');
    return $model;
  }
  
  /*
  public static function __callStatic($name, $arguments) {
    
  } */
}
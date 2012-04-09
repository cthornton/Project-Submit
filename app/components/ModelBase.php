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
    return parent::beforeSave();
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
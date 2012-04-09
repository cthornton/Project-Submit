<?php

class FormHelper {
  
  public $form_action = '', $form_method = 'post', $form_attributes = array();
  
  protected $model;
  
  public function __construct($model) {
    $this->model = $model;
  }
  
  public function __call($name, $arguments) {
    if(count($arguments) == 0)
      throw new Exception("Must pass at least one argument");
    
    $autoLabel = false;
    
    
    //die(substr($name, -5));
    if(substr($name, -5) == 'Label') {
      $autoLabel = true;
      $name = substr($name, 0, -5);
      // die(var_dump($arguments[0]));
    }
    
    $method  = 'active' . strtoupper(substr($name, 0, 1)) . substr($name, 1);
    
    
    if(method_exists('CHtml', $method)) {
      array_unshift($arguments, $this->model);
      return ($autoLabel ? $this->label($arguments[1]) : '') . call_user_func_array('CHtml::' . $method, $arguments);
    } else {
      return parent::__call($name, $arguments);
    }
  }
  
  public function label($attirbute, $htmlOptions = array()) {
    return CHtml::activeLabelEx($this->model, $attirbute, $htmlOptions);
  }
  
  public function submit($label = null, $htmlOptions = array()) {
    if($label == null) {
      $label = $this->model->isNewRecord ? 'Create ' . get_class($this->model) : 'Update ' . get_class($this->model);
    }
    return CHtml::submitButton($label, $htmlOptions);
  }
  
  /*
  public function label($attribute, $htmlOptions = array()) {
    return CHtml::activeLabel($this->model, $attribute, $htmlOptions);
  }
  
  public function textField($attribute, $htmlOptions = array()) {
    return CHtml::activeTextField($this->model, $attribute, $htmlOptions);
  }
  
  public function password($attribute, $htmlOptions = array()) {
    return CHtml::a
  } */
  
}


?>
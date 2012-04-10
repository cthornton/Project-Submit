<?php
/**
 * Helper functions for common tasks
 */

 
define('APP_TIMESTAMP', 'MM/dd/yyyy hh:mm a');
define('APP_SQL_TIMESTAMP', 'yyyy-MM-dd HH:mm:ss');
define('THE_SQL_TIMESTAMP', 'Y-m-d H:i:s');
define('HUMAN_TIMESTAMP', 'F j \a\t g:i a');
define('US_TIMESTAMP', 'M d, Y g:i:s a');
 
 
/**
 * Gets the current application. Shorthand for Yii::app()
 */
function app() {
  return Yii::app();
}


/**
 * Escapes the HTML. Shorthand for CHtml::encode
 */ 
function h($text) {
  return CHtml::encode($text);
}

function stylesheet_tag($src, $media = '') {
  return CHtml::cssFile('/stylesheets/' . $src, $media);
}

function image_tag($src, $alt = '', $htmlOptions = array()) {
  CHtml::image('/images/' . $src, $alt, $htmlOptions);
}

function javascript_include_tag($name) {
  return CHtml::scriptFile('/scripts/' . $name);
}

function form_for(ModelBase $model, $block, $htmlOptions = array()) {
  $helper = new FormHelper($model);
  ob_start();
  $block($helper);
  $content = CHtml::beginForm($helper->form_action, $helper->form_method, $htmlOptions);
  $content .= CHtml::errorSummary($model);
  $content .= ob_get_clean();
  return $content . CHtml::endForm();
}

function link_to($text, $url_or_model, $htmlOptions = array()) {
  if($url_or_model instanceof ModelBase) {
    $klass = Inflector::pluralize(Inflector::underscore(get_class($url_or_model)));
    $url_or_model = array("$klass/view", 'id' => $url_or_model->id);
  }
  return CHtml::link($text, $url_or_model, $htmlOptions);
}

?>
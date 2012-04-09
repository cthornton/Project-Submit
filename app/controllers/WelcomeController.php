<?php

class WelcomeController extends Controller {
  
  public function allowedActions() {
    return 'index, error';
  }
  
  public function actionIndex() {
    $this->render();
  }
  
	public function actionError() {
    if($error=app()->errorHandler->error) {
      if(Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', $error);
    }
	}
  
}
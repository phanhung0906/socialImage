<?php

class SettingsController extends Controller{

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionNotify()
    {
        $this->render('notify');
    }
}
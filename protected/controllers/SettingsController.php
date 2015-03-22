<?php

class SettingsController extends Controller{

   public $userId;

    public function beforeAction()
    {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->getBaseUrl(true));
        } else {
            $this->userId = Yii::app()->user->getState('id');
        }

        return true;
    }

    public function actionIndex()
    {
        $user = User::model()->findByPk($this->userId);

        if (isset($_POST['User'])) {
            $user->attributes = $_POST['User'];
            $user->user_name = $_POST['User']['user_name'];
            $user->scenario = 'updateAccount';

            if ($user->save()) {
                Yii::app()->user->setFlash('success','Update info successfully');
            }
        }

        $this->render('index', array(
            'user' => $user
        ));
    }

    public function actionNotify()
    {
        $this->render('notify');
    }

    public function actionChangePassword()
    {
        $user = User::model()->findByPk($this->userId);

        if (isset($_POST['User'])) {

        }

        $this->render('changePassword', array(
            'user' => $user
        ));
    }

    public function actionProfile()
    {
        $this->render('profile');
    }
}
<?php

class SettingsController extends Controller
{

    public function beforeAction()
    {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->getBaseUrl(true));
        } else {
            $this->userId = Yii::app()->user->getState('id');
        }

        parent::beforeAction();

        return true;
    }

    public function actionIndex()
    {
        $user = User::model()->findByPk($this->userId);
        $email = $user->email;
        $user->scenario = 'updateAccount';

        if (isset($_POST['User'])) {
            $user->attributes = $_POST['User'];

            if ($user->save()) {
                Yii::app()->user->setFlash('success', 'Update info successfully');
            }
        }

        $this->render('index', array(
            'user' => $user,
            'email' => $email
        ));
    }

    public function actionNotify()
    {
        $this->render('notify');
    }

    public function actionChangePassword()
    {
        $user = User::model()->findByPk($this->userId);
        $user->setScenario('changePassword');

        if (isset($_POST['User'])) {
            $user->attributes = $_POST['User'];
            $user->password = Common::genPassword($_POST['User']['newPassword']);

            if ($user->save()) {
                Yii::app()->user->setFlash('success', 'Change password successfully');
            }
        }

        $this->render('changePassword', array(
            'user' => $user
        ));
    }

    public function actionProfile()
    {
        $userDetail = UserDetail::model()->findByPk($this->userId);
        $userDetail->setScenario('updateUser');

        if (isset($_POST['UserDetail'])) {
            $oldLink = $userDetail->image;
            $uploadedFile = CUploadedFile::getInstance($userDetail, 'image');

            $userDetail->attributes = $_POST['UserDetail'];
            $userDetail->oldLink = $oldLink;
            $userDetail->uploadedFile = $uploadedFile;
            $userDetail->image = $oldLink;

            if ($userDetail->save()) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Update info successfully'));
                $this->refresh();
            } else {
                /*Common::debugdie($userDetail->getErrors());*/
            }
        }

        $this->render('profile', array(
            'userDetail' => $userDetail
        ));
    }
}
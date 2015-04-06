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
            if ($uploadedFile) {
                $pathFolder = YiiBase::getPathOfAlias('webroot') . Constant::PATH_UPLOAD . date("Y") . '/' . date("m-d");

                if (!file_exists($pathFolder)) {
                    mkdir($pathFolder, 0777, true);
                }

                $code = uniqid();
                $fileName = $code . '-' . $uploadedFile->name;

                $_POST['UserDetail']['image'] = $userDetail->image = date("Y") . '/' . date("m-d") . '/' . $fileName;
            }

            $userDetail->attributes = $_POST['UserDetail'];

            if ($userDetail->save()) {
                if ($uploadedFile) {
                    if (file_exists(YiiBase::getPathOfAlias('webroot') . Constant::PATH_UPLOAD . $oldLink))
                        unlink(YiiBase::getPathOfAlias('webroot') . Constant::PATH_UPLOAD . $oldLink);
                    $uploadedFile->saveAs($pathFolder . '/' . $fileName);
                }
                Yii::app()->user->setFlash('success', Yii::t('app', 'Update info successfully'));
                $this->refresh();
            } else {
                Common::debugdie($userDetail->getErrors());
            }
        }

        $this->render('profile', array(
            'userDetail' => $userDetail
        ));
    }
}
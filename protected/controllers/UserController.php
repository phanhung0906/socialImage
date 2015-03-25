<?php

class UserController extends Controller
{

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
        $this->redirect(array('board'));
    }

    public function actionBoard()
    {
        $userId = Yii::app()->user->getState('id');
        //Show album
        $ownAlbum = Album::model()->findAllByAttributes(array('user_id' => $userId, 'del_flg' => Constant::DEL_FALSE));

        //create new album
        $album = new Album();

        if (isset($_POST['Album'])) {
            $album->attributes = $_POST['Album'];
            $album->description = trim($_POST['Album']['description']);
            $album->user_id = $userId;
            $album->code = uniqid();

            if ($album->save()) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Create new album successfully'));
                $this->refresh();
            }
        }

        $this->render('board', array(
            'album' => $album,
            'ownAlbum' => $ownAlbum
        ));
    }

    public function actionAlbum($code)
    {
        $album = Album::model()->findByAttributes(array('code' => $code));

        $this->render('album', array(
            'album' => $album
        ));
    }
}
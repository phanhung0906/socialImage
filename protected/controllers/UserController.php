<?php

class UserController extends Controller
{

  /*  public function beforeAction()
    {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->getBaseUrl(true));
        } else {
            $this->userId = Yii::app()->user->getState('id');
        }

        return true;
    }*/

    /**
     * socialImage.lcoal/user/{username}
     */
    public function actionView($username) {
        $model = User::model()->findByAttributes(array('user_name' => $username, 'del_flg' => Constant::DEL_FALSE));

        if(!$model) $this->redirect(Yii::app()->homeUrl);

        $userId = Yii::app()->user->getState('id');
        $userPageId = $model->id;
        $userPageDetail = UserDetail::model()->findByAttributes(array('user_id' => $userPageId));

        //Show album
        $ownAlbum = Album::model()->findAllByAttributes(array('user_id' => $userPageId, 'del_flg' => Constant::DEL_FALSE));

        //Show Timeline
        $timeline = Photo::model()->with('album.user')->findAll();

        //create new album
        $album = new Album();

        if (isset($_POST['Album'])) {
            $album->attributes = $_POST['Album'];
            $album->description = trim($_POST['Album']['description']);
            $album->user_id = $userPageId;
            $album->code = uniqid();

            if ($album->save()) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Create new album successfully'));
                $this->refresh();
            }
        }

        $this->render('view', array(
            'album' => $album,
            'ownAlbum' => $ownAlbum,
            'userPageId' => $userPageId,
            'userId' => $userId,
            'model' => $model,
            'userPageDetail' => $userPageDetail,
            'timeline' => $timeline
        ));
    }

 /*   public function actionIndex()
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

    public function actionAlbum($code, $update = false)
    {
        $album = Album::model()->findByAttributes(array('code' => $code, 'del_flg' => Constant::DEL_FALSE));

        if(!$album) $this->redirect(array('index'));

        $listPhoto = Photo::model()->findAllByAttributes(array('album_id' => $album->id, 'del_flg' => Constant::DEL_FALSE));
        $step = 1;

        if($update){
            $step = 2;
        }

        // Create new photo
        if (isset($_POST) && !empty($_FILES['image']['tmp_name'])) {
            $pathFolder = YiiBase::getPathOfAlias('webroot') . Constant::PATH_UPLOAD . date("Y") . '/' . date("m-d");

            if (!file_exists($pathFolder)) {
                mkdir($pathFolder, 0777, true);
            }

            $code = uniqid();
            $fileName = $code . '-' . $_FILES['image']['name'];
            $photo = new Photo();
            $photo->code = $code;
            $photo->name = Common::getNamePhoto($_FILES['image']['name']);
            $photo->album_id = $album->id;
            $photo->url = date("Y") . '/' . date("m-d").'/' . $fileName;

            if ($photo->save()) {
                move_uploaded_file($_FILES['image']['tmp_name'], $pathFolder . '/' . $fileName);
                Yii::app()->user->setFlash('success', Yii::t('app', 'Create new photo successfully'));
                $photo = new Photo();
                $this->refresh();
            } else {
                Common::debugdie($photo->getErrors());
            }
        }

        $this->render('album', array(
            'album' => $album,
            'listPhoto' => $listPhoto,
            'code' => $code,
            'step' => $step
        ));
    }*/
}
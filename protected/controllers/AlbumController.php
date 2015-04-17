<?php

class AlbumController extends Controller{

   /* public function beforeAction()
    {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->getBaseUrl(true));
        } else {
            $this->userId = Yii::app()->user->getState('id');
        }

        return true;
    }*/

    /*
     * Show Album follow code
     */
    public function actionView($code, $update = false)
    {
        $album = Album::model()->findByAttributes(array('code' => $code, 'del_flg' => Constant::DEL_FALSE));

        if(!$album) $this->redirect(array('index'));

        $userId = Yii::app()->user->getState('id');
        $userPageId = $album->user_id;
        $userPageInfo = User::model()->findByPk($userPageId);
        $listPhoto = Photo::model()->findAllByAttributes(array('album_id' => $album->id, 'del_flg' => Constant::DEL_FALSE), array('order' => 'created DESC', 'limit' => Constant::PHOTO_PER_PAGE));
        $step = 1;

        if ($update) {
            $step = 2;
        }

        // Create new photo
        $photoUpload = new Photo();
        if (isset($_POST['Photo']) && !empty($_FILES['image']['tmp_name'])) {
            $pathFolder = YiiBase::getPathOfAlias('webroot') . Constant::PATH_UPLOAD . date("Y") . '/' . date("m-d");

            if (!file_exists($pathFolder)) {
                mkdir($pathFolder, 0777, true);
            }

            $code = uniqid();
            $fileName = $code . '-' . $_FILES['image']['name'];

            $photoUpload->attributes = $_POST['Photo'];
            $photoUpload->code = $code;
//            $photoUpload->name = Common::getNamePhoto($_FILES['image']['name']);
            $photoUpload->album_id = $album->id;
            $photoUpload->url = date("Y") . '/' . date("m-d").'/' . $fileName;

            if ($photoUpload->save()) {
                move_uploaded_file($_FILES['image']['tmp_name'], $pathFolder . '/' . $fileName);
                Yii::app()->user->setFlash('success', Yii::t('app', 'Create new photo successfully'));
                $photoUpload = new Photo();
                $this->refresh();
            } else {
                Common::debugdie($photoUpload->getErrors());
            }
        } else if(isset($_POST['Photo']) && empty($_FILES['image']['tmp_name'])){
            Yii::app()->user->setFlash('error', Yii::t('app', 'You must select your image'));
        }

        // Ajax like button
        if (isset($_POST['number']) && Yii::app()->request->isAjaxRequest) {
             echo json_encode(Photo::model()->findAllByAttributes(
                array(
                    'album_id' => $album->id,
                    'del_flg' => Constant::DEL_FALSE
                ),
                array(
                    'order' => 'created DESC',
                    'limit' => Constant::PHOTO_PER_PAGE,
                    'offset' => $_POST['number'] * Constant::PHOTO_PER_PAGE
                )
            ));
            Yii::app()->end();
        }

        $this->render('view', array(
            'album' => $album,
            'listPhoto' => $listPhoto,
            'code' => $code,
            'step' => $step,
            'userId' => $userId,
            'userPageId' => $userPageId,
            'userPageInfo' => $userPageInfo,
            'photoUpload' => $photoUpload
        ));
    }

}
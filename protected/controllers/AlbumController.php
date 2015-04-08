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
            'userPageInfo' => $userPageInfo
        ));
    }

}
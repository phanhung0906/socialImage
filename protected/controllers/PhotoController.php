<?php

class PhotoController extends Controller{

    /**
     * View detail 1 photo
     */
    public function actionView($code)
    {
        $photo = Photo::model()->findByAttributes(array('code' => $code, 'del_flg' => Constant::DEL_FALSE));

        if(!$photo) $this->redirect(Yii::app()->homeUrl);

        $album = Album::model()->findByPk($photo->album_id, 'del_flg = ' . Constant::DEL_FALSE);

        if(!$album) $this->redirect(Yii::app()->homeUrl);

        $user = User::model()->findByPk($album->user_id, 'del_flg = ' . Constant::DEL_FALSE);

        if(!$user) $this->redirect(Yii::app()->homeUrl);

        $likePhoto = LikePhoto::model()->findAllByAttributes(array('photo_id' => $photo->id));
        $countLike = count($likePhoto);
        $dislikePhoto = DislikePhoto::model()->findAllByAttributes(array('photo_id' => $photo->id));
        $countDislike = count($dislikePhoto);

        $userId = Yii::app()->user->getState('id');
//        $userPageId = $album->user_id;
//        $isOwn = ($userId == $userPageId) ? true : false;

        //Check current user like or not
        $checkLikeModel = LikePhoto::model()->findByAttributes(array('user_id' => $userId, 'photo_id' => $photo->id));
        $checkLike = empty($checkLikeModel) ? false : true;
        $checkDislikeModel = DislikePhoto::model()->findByAttributes(array('user_id' => $userId, 'photo_id' => $photo->id));
        $checkDislike = empty($checkDislikeModel) ? false : true;

        //Collum 2
        $feature = Photo::model()->findAllByAttributes(array('del_flg' => Constant::DEL_FALSE),  array('order' => 'created DESC', 'limit' => Constant::PHOTO_PER_PAGE));

        // Ajax like button
        if (isset($_POST['userLikeId']) && Yii::app()->request->isAjaxRequest) {
            $mdoel = LikePhoto::model()->findByAttributes(array('user_id' => $_POST['userLikeId'], 'photo_id' => $photo->id));

            if($mdoel){
                LikePhoto::model()->deleteByPk($mdoel->id);
                echo Constant::LIKE_EXIST;
            } else {
                $model = new LikePhoto();
                $model->user_id = $_POST['userLikeId'];
                $model->photo_id = $photo->id;

                if ($model->save()) {
                    echo Constant::LIKE_SAVE_SUCCESS;
                } else {
                    echo Constant::LIKE_SAVE_FALSE;
                }
            }
            Yii::app()->end();
        }

        // Ajax dislike button
        if (isset($_POST['userDislikeId']) && Yii::app()->request->isAjaxRequest) {
            $mdoel = DislikePhoto::model()->findByAttributes(array('user_id' => $_POST['userDislikeId'], 'photo_id' => $photo->id));
            if($mdoel){
                DislikePhoto::model()->deleteByPk($mdoel->id);
                echo Constant::LIKE_EXIST;
            } else {
                $model = new DislikePhoto();
                $model->user_id = $_POST['userDislikeId'];
                $model->photo_id = $photo->id;

                if ($model->save()) {
                    echo Constant::LIKE_SAVE_SUCCESS;
                } else {
                    echo Constant::LIKE_SAVE_FALSE;
                }
            }
            Yii::app()->end();
        }

        $this->render('view', array(
            'photo' => $photo,
            'user' => $user,
            'countLike' => $countLike,
            'countDislike' => $countDislike,
            'userId' => $userId,
            'checkLike' => $checkLike,
            'checkDislike' => $checkDislike,
            'feature' => $feature
//            'isOwn' => $isOwn
        ));
    }
}
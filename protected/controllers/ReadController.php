<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hung
 * Date: 4/3/15
 * Time: 2:05 PM
 * To change this template use File | Settings | File Templates.
 */

class ReadController extends Controller{

    public function actionDelete($id){
        $model = Photo::model()->findByPk($id);
        unlink(YiiBase::getPathOfAlias('webroot') . Constant::PATH_UPLOAD . $model->url);
        Photo::model()->deleteByPk($id);
        Yii::app()->user->setFlash('success', Yii::t('app', 'Delete photo successfully'));
        $this->redirect(Yii::app()->homeUrl);
    }
}
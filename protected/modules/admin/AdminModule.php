<?php

class AdminModule extends CWebModule
{
    public $defaultController = 'default';
    public $homeUrl = 'admin/';

    public function init()
    {
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*'
        ));

        Yii::app()->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'admin/default/error',
            )
        ));

        $this->components = array(
            'user' => array(
                'class' => 'AdminWebUser',
                'loginUrl' => Yii::app()->createUrl('admin/default/login'),
                'returnUrl' => Yii::app()->createUrl('admin/default/index'),
                'allowAutoLogin' => true,
            )
        );

        Yii::app()->user->setStateKeyPrefix('_admin');
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action))
        {
            // this method is called before any module controller action is performed
            $route = $controller->id . '/' . $action->id;
            $publicPages = array(
                'default/error',
                'default/login',
                'default/forgot',
                'default/changepassword',
            );

            if (Yii::app()->getModule("{$this->id}")->user->isGuest && !in_array($route, $publicPages))
            {


                /* set the return URL */
                $request = Yii::app()->request->getUrl();
                Yii::app()->getModule("{$this->id}")->user->returnURL = $request;

                /* redirect to module login form */
                Yii::app()->getModule("{$this->id}")->user->loginRequired();
            } else {
                unset($publicPages[0]); //Ignore error page
                if (!Yii::app()->getModule("{$this->id}")->user->isGuest
                    && in_array($route, $publicPages))
                {
                    Yii::app()->request->redirect(Yii::app()->getModule("{$this->id}")->user->returnURL);
                }

                //Allow to access
                return true;
            }
        }
        return false;
    }
}
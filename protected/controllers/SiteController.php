<?php

class SiteController extends Controller
{

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		/*$model = new ContactForm;

		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}*/

        $model = new Contact;

        if (isset($_POST['Contact'])) {
            $model->attributes = $_POST['Contact'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }

		$this->render('contact',array('model'=>$model));
	}

    /**
     * Displays Register page
     */
    public function actionRegister()
    {
        // Check user logined
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->getBaseUrl(true));
        }

        $modelUser = new User('register');
        $modelUserDetail = new UserDetail();

        if (isset($_POST['User'])) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $modelUser->attributes = $_POST['User'];
                $modelUser->user_name = uniqid();

                if (!$modelUser->save()) {
                    throw new CException(CHtml::errorSummary($modelUser));
                }

                $modelUserDetail->user_id = $modelUser->id;

                if (!$modelUserDetail->save()) {
                    throw new CException(CHtml::errorSummary($modelUserDetail));
                }

                $transaction->commit();
                $this->redirect(Yii::app()->getBaseUrl(true));
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error','Regiser error');
            }
        }

        $this->render('register', array(
            'model' => $modelUser
        ));
    }

    /**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        if (!Yii::app()->user->isGuest) $this->redirect(Yii::app()->homeUrl);

        // login
        $modelLogin = new LoginForm;
        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $modelLogin->attributes = $_POST['LoginForm'];
            // validate user input and redirect to previous page if valid
            if ($modelLogin->validate() && $modelLogin->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            } else {
                Yii::app()->user->setFlash('error', Yii::t('app', 'Wrong email or password! Please try again.'));
            }
        }

        $this->render('login', array('model'=>$modelLogin));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
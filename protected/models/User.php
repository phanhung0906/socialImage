<?php

/**
 * This is the model class for table "tb_user".
 *
 * @property int $id
 * @property string $code
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $status
 * @property string $token
 * @property string $created
 * @property string $updated
 * @property string $del_flg
 */
class User extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public $id;
    public $code;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $user_name;

    public $confirmPassword;
    public $oldPassword;
    public $newPassword;
    public $retypePassword;
    public $agree;

    public function tableName()
    {
        return 'tb_user';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('email, password, first_name, last_name, user_name', 'required', 'on'=>'register, updateAccount'),
            array('email', 'email','on' => 'register, updateAccount'),
            array('email','validateMail', 'on'=>'register, updateAccount'),
            array('user_name','validateUserName', 'on'=>'register, updateAccount'),
            array('password','validatePassword','on'=>'register'),
            array('password', 'length','min' => 6, 'on'=>'register'),
            array('confirmPassword', 'compare', 'compareAttribute'=>'password', 'on'=>'register'),
            array('agree', 'compare', 'compareValue' => true, 'message' => 'You should accept term to use our service','on'=>'register'),

            //update
            array('old_password, password, confirmPassword', 'safe', 'on'=>'updateUserInfomation'),

            //forgot password
            array('email', 'required', 'on' => 'forgot'),
            array('email', 'email'),
            array('changePass', 'safe','on'=>'forgot'),
            array('memship_id', 'required', 'on'=>'upgradeMember'),

            // change password
            array('oldPassword, newPassword', 'required', 'on' => 'changePassword'),
            array('oldPassword', 'validatePassword', 'on' => 'changePassword'),
            array('newPassword', 'length', 'min' => 6, 'on' => 'changePassword'),
            array('retypePassword', 'compare', 'compareAttribute' => 'newPassword', 'on'=>'changePassword'),

        );
    }

    /*
    * validate receive email 
    */
   /* function validateReceive(){
        if (!$this->receive_type || !in_array($this->receive_type, array(Constant::RECEIVE_EMAIL, Constant::RECEIVE_EMAIL_MOBILE, Constant::RECEIVE_ALL))) {
            $this->addError('receive_type', Yii::t('app','Choose which type of email to get mail magazine'));

        } elseif ($this->receive_type == Constant::RECEIVE_EMAIL ) {
            $validator = CValidator::createValidator('required', $this, 'email');
            $validator->validate($this);

        } elseif ($this->receive_type == Constant::RECEIVE_EMAIL_MOBILE ) {
            $validator = CValidator::createValidator('required', $this, 'email_mobile');
            $validator->validate($this);

        } elseif ($this->receive_type == Constant::RECEIVE_ALL ) {
            $validator = CValidator::createValidator('required', $this, 'email, email_mobile');
            $validator->validate($this);
        }
    }*/

    public function validatePassword($attributes, $params) {
        if ($this->scenario == 'changePassword') {
            $userId = Yii::app()->user->getState('id');
            $user = self::model()->findByPk($userId);

            if($this->$attributes != Common::decodePassword($user->password))
                $this->addError($attributes, Yii::t('app', 'Old password is wrong'));
        } else {
            if(!preg_match('/^(?=.*\d)(?=.*[a-zA-Z]).+$/', $this->password))
                $this->addError('password', Yii::t('app','Password must have numberic and character'));
        }
    }

    public function validateMail($attribute, $params) {
        if (!empty($this->$attribute)) {
            $params = array(':email' => $this->$attribute);
            $condition = 'del_flg = '. Constant::DEL_FALSE .' and (email = :email)';

            if ($this->scenario == 'updateAccount') {
                $condition .= ' and id <> :user_id';
                $params[':user_id'] = $this->id;
            }

            $count = self::model()->count($condition, $params);

            if ($count) {
                $this->addError($attribute, Yii::t('app', '{email} already exists in the system.', array('{email}' => $this->$attribute)));
            }
        }
    }

    public function validateUserName($attribute, $params)
    {
        if (!empty($this->$attribute)) {
            $params = array(':user_name' => $this->$attribute);
            $condition = 'del_flg = '. Constant::DEL_FALSE .' and (user_name = :user_name)';

            if ($this->scenario == 'updateAccount') {
                $condition .= ' and id <> :user_id';
                $params[':user_id'] = $this->id;
            }

            $count = self::model()->count($condition, $params);

            if ($count) {
                $this->addError($attribute, Yii::t('app', '{user_name} already exists in the system.', array('{user_name}' => $this->$attribute)));
            }
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('user','User ID'),
            'email' => Yii::t('user','Email'),
            'password' => Yii::t('app','Password'),
            'confirmPassword' => Yii::t('app','Confirm password'),
            'status' => Yii::t('app','Status'),
            'created' => Yii::t('app','Created date'),
            'updated' => Yii::t('app','Updated date'),
            'del_flg' => Yii::t('app','Delete flag'),
        );
    }

    /**
     * cal before validate
     */
    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    /**
     * call before save
     */
    public function beforeSave()
    {
        $now = new CDbExpression('NOW()');
        if ($this->isNewRecord)
            $this->created = $now;
        $this->updated = $now;

        if($this->scenario == 'register') {
            $this->password = Common::genPassword($this->password);
        }

        return parent::beforeSave();
    }
    
}
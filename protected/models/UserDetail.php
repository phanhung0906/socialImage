<?php

class UserDetail extends CActiveRecord{

    public $user_id;
    public $phone;
    public $gender;
    public $birthday;
    public $status;
    public $image;

    public function tableName()
    {
        return 'tb_user_detail';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('user_id','required'),

            array('phone', 'length','min'=>10, 'max'=>20, 'on'=>'updateUserInfomation'),
            array('phone', 'match', 'pattern'=>'/^[0-9-()\s+]+$/', 'on'=>'updateUserInfomation'),
            array('email, phone, first_name, last_name, gender, birthday, status', 'safe', 'on'=>'search'),
        );
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    public function beforeSave()
    {
        $now = new CDbExpression('NOW()');
        if ($this->isNewRecord)
            $this->created = $now;
        $this->updated = $now;

        return parent::beforeSave();
    }
}
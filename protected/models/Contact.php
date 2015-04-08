<?php

class Contact extends CActiveRecord{

    public $name;
    public $email;
    public $phone;
    public $address;
    public $content;
    public $updated;
    public $created;

    public function tableName()
    {
        return 'tb_contact';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('name, email, content', 'required'),
            array('email', 'email'),
            array('phone, address','safe'),
            array('phone', 'length','min'=>10, 'max'=>20),
            array('phone', 'match', 'pattern'=>'/^[0-9-()\s+]+$/'),
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
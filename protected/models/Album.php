<?php

class Album extends CActiveRecord{

    public $id;
    public $code;
    public $name;
    public $description;
    public $created;
    public $updated;

    public function tableName()
    {
        return 'tb_album';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('name','required'),
            array('name', 'length', 'max' => 45)
        );
    }

    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'photo' => array(self::HAS_MANY, 'Photo', 'album_id', 'order' => 'photo.created DESC'),
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
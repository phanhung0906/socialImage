<?php

class Photo extends CActiveRecord{

    public $id;
    public $code;
    public $name;
    public $description;
    public $url;
    public $created;
    public $updated;

    public function tableName()
    {
        return 'tb_photo';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('name, url','required'),
            array('name', 'length', 'max' => 45),
            array('url', 'file', 'types'=>'jpg, gif, png'),

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
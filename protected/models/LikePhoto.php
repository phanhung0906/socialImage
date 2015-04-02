<?php

class LikePhoto extends CActiveRecord {

    public $id;
    public $user_id;
    public $photo_id;
    public $created;
    public $updated;

    public function tableName()
    {
        return 'tb_like_photo';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('user_id, photo_id','required')
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
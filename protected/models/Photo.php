<?php

class Photo extends CActiveRecord{

    public $id;
    public $album_id;
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
            array('description','safe')
        );
    }

    public function relations()
    {
        return array(
            'album' => array(self::BELONGS_TO, 'Album', 'album_id'),
        );
    }

    public static function countPhoto($albumId)
    {
        return self::model()->count('album_id = :albumId', array('albumId' => $albumId));
    }

    public static function getImage($albumId)
    {
        $model = self::model()->findByAttributes(array('album_id' => $albumId, 'del_flg' => Constant::DEL_FALSE), array('order' => 'created DESC'));

        return empty($model) ? false : $model->url;
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
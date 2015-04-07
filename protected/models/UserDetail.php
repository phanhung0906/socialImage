<?php

class UserDetail extends CActiveRecord{

    public $user_id;
    public $phone;
    public $gender;
    public $birthday;
    public $status;
    public $image;
    public $description;
    public $website;
    public $oldLink;
    public $uploadedFile;

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
            array('description, website, gender, image','safe'),
            array('website', 'url', 'defaultScheme' => 'http'),
            array('phone', 'length','min'=>10, 'max'=>20, 'on'=>'updateUser'),
            array('phone', 'match', 'pattern'=>'/^[0-9-()\s+]+$/', 'on'=>'updateUser'),
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

        if(is_object($this->uploadedFile)) {
            $pathFolder = YiiBase::getPathOfAlias('webroot') . Constant::PATH_UPLOAD . date("Y") . '/' . date("m-d");

            if (!file_exists($pathFolder)) {
                mkdir($pathFolder, 0777, true);
            }

            $code = uniqid();
            $fileName = $code . '-' . $this->uploadedFile->name;
            $this->image = date("Y") . '/' . date("m-d") . '/' . $fileName;
            $this->uploadedFile->saveAs($pathFolder . '/' . $fileName);

            if (!empty($this->oldLink) && file_exists(YiiBase::getPathOfAlias('webroot') . Constant::PATH_UPLOAD . $this->oldLink))
                unlink(YiiBase::getPathOfAlias('webroot') . Constant::PATH_UPLOAD . $this->oldLink);
        }

        return parent::beforeSave();
    }
}
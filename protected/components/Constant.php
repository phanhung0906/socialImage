<?php

/**
 * Class Constant
 *
 * Define constant using in project
 * May contain constant variable, array or other format
 */
class Constant {
    const ADMIN_EMAIL = 'admin@socialimage.com';

    const PER_PAGE = 100;
    const PATH_ATTACHMENT = '/uploads/mail_magazine/attachments/';
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const DEL_TRUE = 1;
    const DEL_FALSE = 0;

    /**
     * Constant of loginType
     */
    const LOGIN_FROM_BACKEND = 1;
    const LOGIN_FROM_FACEBOOK = 2;
    const LOGIN_FROM_TWITTER = 3;
    const LOGIN_FROM_GOOGLE = 4;
    const LOGIN_FROM_FRONTEND = 5;

    /**
     * Constant of send mail
     */
    const HOST = 'smtp.gmail.com';
    const SMTPSECURE = 'tls';
    const EMAIL_SEND = 'atmarkcafevn@gmail.com';
    const PORT = '587';
    const PASSWORD = 'acvdevvn';
    const MAILER = 'smtp';
    const CHARSET = 'utf-8';

    static function loginType($status = null) {
        static $base = null;
        if (!isset($base))
            $base = array(
                self::LOGIN_FROM_BACKEND => Yii::t('app', 'Backend'),
                self::LOGIN_FROM_FACEBOOK => Yii::t('app', 'Facebook'),
                self::LOGIN_FROM_TWITTER => Yii::t('app', 'Twitter'),
                self::LOGIN_FROM_GOOGLE => Yii::t('app', 'Google'),
                self::LOGIN_FROM_FRONTEND => Yii::t('app', 'Frontend')
            );
        return !empty($base[$status]) ? $base[$status] : ($base);
    }

}

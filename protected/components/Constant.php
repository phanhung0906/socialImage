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
    const PATH_UPLOAD = '/images/uploads/';
    const PATH_NO_IMAGE = '/images/750x450.png/';
//    const STATUS_ACTIVE = 1;
//    const STATUS_INACTIVE = 0;
    const DEL_TRUE = 1;
    const DEL_FALSE = 0;

    /**
     * Ajax
     */
    const LIKE_EXIST = 1;
    const LIKE_SAVE_SUCCESS = 2;
    const LIKE_SAVE_FALSE = 3;

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

}

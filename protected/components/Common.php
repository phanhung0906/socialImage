<?php

/**
 * Class Common
 *
 * Popular function or method using in project
 */
class Common
{
    
    public static function datediff($date1, $date2) {
        $from =  is_int($date1) ? strtotime(date('Y-m-d', $date1)) : strtotime($date1);
        $to = is_int($date2) ? strtotime(date('Y-m-d', $date2)) : strtotime($date2);
        
        $difference = $from - $to;
        return floor($difference / (60 * 60 * 24));
    }
    /**
     * Debug
     *
     * Simple formatted debug function
     */
    public static function debug($var)
    {
        echo '<pre style="text-align: left;font-size: 14px;">';
        $trace = debug_backtrace();
        echo 'Line: ' . $trace[0]['line'] . '<br>';
        print_r($var);
        echo '</pre>';
    }

    /**
     * Debug then die
     *
     * Stop where you call the function
     */
    public static function debugdie($var)
    {
        echo '<pre style="text-align: left;font-size: 14px;">';
        $trace = debug_backtrace();
        echo 'Line: ' . $trace[0]['line'] . '<br>';
        print_r($var);
        echo '</pre>';
        die();
    }

    /*
    * generator token auto login
    */
    public static function genTokenLogin($userId) {
        return md5($userId.'kgfoerlsdfl3hhg90f1');
    }

    /*
    * Generator url login
    */

    public static function genLoginUrl($userId = null) {
        return isset($userId) ? Yii::app()->getBaseUrl(true).'/user/autologin?id='.$userId.'&token='.self::genTokenLogin($userId) : Yii::app()->getBaseUrl(true);
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * generate password
     * string $pass
     */
    public static function genPassword($password)
    {
        for ($i=1; $i<=5; $i++){
            $password = self::generateRandomString($i%2+1) . base64_encode($password);
        }
        return $password;
    }
    
    /**
     * generate password backend
     * string $pass
     */
    public static function genPasswordAdmin($password)
    {
        return md5($password.'fdjr26y9klo') ;
    }
    

    /**
     * decode password
     * string $pass
     */
    public static function decodePassword($password)
    {
        for ($i=5; $i>=1; $i--){
            $password = substr($password, $i%2+1);
            $password = base64_decode($password);
        }
        return $password;
    }
    
    /**
     * Check current controler/action
     */
    public static function checkActive($controller, $action, $echo = 'actived') {
        static $currentControler;
        static $currentAction;

        if(!isset($currentControler))
            $currentControler = Yii::app()->controller->id;
        
        if(!isset($currentAction))
            $currentAction = Yii::app()->controller->action->id;

        if (in_array($currentControler, (array)$controller) && in_array($currentAction, (array)$action)) {
            return $echo;
        }
        
        return ''; 
    }
    
    public static function getVar($param,$default=''){
        return Yii::app()->request->getParam($param,$default);
        
    }
    
    /**
     * method use : baseUrl('admin/use') ,instead use Yii::app()->baseUrl.'admin/use'
    */
    
    public static function getBaseUrl($baseUrl){
        return Yii::app()->getBaseUrl(true).'/'.$baseUrl;
    }
    
    
    /**
     * Generate html code flash success or dont success
     */ 
    public static function getflashSuccess(){
        $success = Yii::app()->user->hasFlash('alert-success');
        $error = Yii::app()->user->hasFlash('alert-danger');
    
        $alert = '';
        if($success)
            $alert = 'alert-success';
        elseif($error)
        $alert = 'alert-danger';
    
        $str = '';
        if($alert)
            $str = '<div class="alert '.$alert.' alert-dismissable">'.
            '<i class="fa fa-check"></i>'.
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'.
            Yii::app()->user->getFlash($alert).
            '</div>';
        return $str;
    }

    
    /**
     * 
     * @param unknown $str
     * @param unknown $length
     * @param number $minword
     * @return string
     */
    public static function cutString($str, $length=100)
    {
        $sub = '';
        $len = 0;
        $str = strip_tags($str);
        $pattern = "/\s+/";
        $str = preg_replace($pattern, ' ', $str);
        foreach (explode(' ', $str) as $word)
        {
            $part = (($sub != '') ? ' ' : '') . $word;
            $sub .= $part;
            $len += strlen($part);
            if (strlen($sub) >= $length)
            {
                break;
            }
        }
        return $sub . (($len < strlen($str)) ? ' ... ' : '');
    }

    /**
     * check date null or not
     */
    public static function checkDate($date = null)
    {
        if ($date == '0000-00-00') return '';
        return $date;
    }

    /**
     * Generate an random token
     */
    public static function genToken()
    {
        return uniqid('token_');
    }

    public static function getNamePhoto($nameExtend){
        $name = explode('.', $nameExtend);
        return $name[0];
    }

}
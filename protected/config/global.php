<?php
/**
 * Shortcut to DIRECTORY_SEPARATOR
 */
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

/**
 * Shortcut to Yii::app()
 */
function app()
{
    return Yii::app();
}

/**
 * Shortcut to Yii::app()->user.
 */
function user()
{
    return Yii::app()->getUser();
}

/**
 * Shortcut to Yii::app()->clientScript
 */
function cs()
{
    // You could also call the client script instance via Yii::app()->clientScript
    // But this is faster
    return Yii::app()->getClientScript();
}

/**
 * Debug with syntax highlight
 */
function debug()
{
    $args = func_get_args();
    $trace = debug_backtrace();
    foreach($args as $k => $arg){
        echo '<fieldset class="debug">
        <legend>(' . ($k+1) . ') Line : ' .  $trace[0]['line'] . '</legend>';
        CVarDumper::dump($arg, 10, true);
        echo '</fieldset>';
    }
}

/**
 * Debug then die with syntax highlight
 */
function debugdie()
{
    $args = func_get_args();
    $trace = debug_backtrace();
    foreach($args as $k => $arg){
        echo '<fieldset class="debug">
        <legend>(' . ($k+1) . ') Line : ' .  $trace[0]['line'] . '</legend>';
        CVarDumper::dump($arg, 10, true);
        echo '</fieldset>';
    }
    die();
}

/**
 * This is the shortcut to Yii::app()->createUrl()
 */
function url($route, $params = array(), $ampersand = '&')
{
    return Yii::app()->createUrl($route, $params, $ampersand);
}

/**
 * This is the shortcut to CHtml::encode
 */
function h($text)
{
    return htmlspecialchars($text, ENT_QUOTES, Yii::app()->charset);
}

/**
 * This is the shortcut to CHtml::link()
 */
function l($text, $url = 'javascript:void(0)', $htmlOptions = array())
{
    return CHtml::link($text, $url, $htmlOptions);
}

/**
 * This is the shortcut to Yii::t() with default category = 'stay'
 */
function t($message, $category = 'app', $params = array(), $source = null, $language = null)
{
    return Yii::t($category, $message, $params, $source, $language);
}

/**
 * This is the shortcut to Yii::app()->request->baseUrl
 * If the parameter is given, it will be returned and prefixed with the app baseUrl.
 */
function baseUrl($url = null)
{
    static $baseUrl;
    if ($baseUrl === null)
        $baseUrl = Yii::app()->getRequest()->getBaseUrl();
    return $url === null ? $baseUrl : $baseUrl . '/' . ltrim($url, '/');
}

/**
 * Returns the named application parameter.
 * This is the shortcut to Yii::app()->params[$name].
 */
function param($name)
{
    return Yii::app()->params[$name];
}
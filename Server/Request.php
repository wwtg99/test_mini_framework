<?php

/**
 * Created by PhpStorm.
 * User: wwt
 * Date: 2017/6/18
 * Time: 16:00
 */
class Request
{

    private static $instance = null;

    /**
     * @var string
     */
    public $url = '';

    /**
     * @return Request
     */
    public static function get()
    {
        if (!self::$instance) {
            self::$instance = new Request();
        }
        return self::$instance;
    }

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
    }

    /**
     * @param $key
     * @param $default
     * @return string|array
     */
    public function input($key = null, $default = null)
    {
        if ($key) {
            return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
        }
        return $_REQUEST;
    }
}
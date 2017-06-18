<?php
/**
 * Created by PhpStorm.
 * User: wwt
 * Date: 2017/6/18
 * Time: 17:47
 */


$config = require 'config.php';

$engine = new Engine($config);
$engine->route('/login', function() {
    $request = Request::get();
    $user = $request->input('username');
    $pwd = $request->input('password');
    $response = Response::get();
    $response->addData('user', $user)->addData('password', $pwd);
    return $response;
});
$engine->route('/logout', function() {
    $response = Response::get();
    $response->addData('logout', '1');
    return $response;
});
$engine->dispatch();

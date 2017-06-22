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
    $sql = "select * from users where name = :name and password = :pwd";
    $stat = DB::get()->prepare($sql);
    $stat->execute(['name'=>$user, 'pwd'=>$pwd]);
    $res = $stat->fetch(PDO::FETCH_ASSOC);
    if ($res) {
        session_start();
        $_SESSION['user'] = $res;
    } else {
        $res = [];
    }
    $response = Response::get();
    $response->setData($res);
    return $response;
});
$engine->route('/is_login', function () {
    session_start();
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : [];
    $response = Response::get();
    $response->setData($user);
    return $response;
});
$engine->route('/logout', function() {
    $response = Response::get();
    $response->addData('logout', '1');
    return $response;
});
$engine->dispatch();

<?php

/**
 * Created by PhpStorm.
 * User: wwt
 * Date: 2017/6/18
 * Time: 17:04
 */
class Engine
{

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var array
     */
    protected $routes = [];

    /**
     * Engine constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param $uri
     * @param $callback
     * @return $this
     */
    public function route($uri, $callback)
    {
        $this->routes[$uri] = $callback;
        return $this;
    }

    public function dispatch()
    {
        try {
            $request = Request::get();
//            $db = DB::get($this->config);
            if (isset($this->routes[$request->url])) {
                $callback = $this->routes[$request->url];
                if (is_callable($callback)) {
                    $res = $callback();
                } else {
                    $res = Response::get()->setCode(500)->setError('Server Error');
                }
            } else {
                $res = Response::get()->setCode(404)->setError('Not Found');
            }
        } catch (Exception $e) {
            $res = Response::get()->setCode($e->getCode())->setError($e->getMessage());
        }
        $res->responseJson();
    }

}
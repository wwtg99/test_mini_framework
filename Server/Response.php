<?php

/**
 * Created by PhpStorm.
 * User: wwt
 * Date: 2017/6/18
 * Time: 16:00
 */
class Response
{

    private static $instance = null;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var int
     */
    protected $code = 200;

    /**
     * @var string
     */
    protected $error = '';

    /**
     * @return Response
     */
    public static function get()
    {
        if (!self::$instance) {
            self::$instance = new Response();
        }
        return self::$instance;
    }

    /**
     * Response constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function responseJson()
    {
        header("HTTP/1.1 " . $this->getCode());
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        if ($this->error) {
            echo json_encode(['error'=>$this->error]);
        } else {
            if (is_array($this->data)) {
                echo json_encode($this->data, JSON_UNESCAPED_UNICODE);
            } else {
                echo $this->data;
            }
        }
    }

    /**
     * @param $key
     * @param $item
     * @return $this
     */
    public function addData($key, $item)
    {
        $this->data[$key] = $item;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return Response
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return Response
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     * @return Response
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }


}
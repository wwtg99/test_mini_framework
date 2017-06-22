<?php

/**
 * Created by PhpStorm.
 * User: wwt
 * Date: 2017/6/18
 * Time: 16:25
 */
class DB
{

    private static $instance = null;

    /**
     * @var PDO
     */
    protected $pdo = null;

    /**
     * @param array $config
     * @return DB
     */
    public static function get($config = [])
    {
        if (!self::$instance) {
            self::$instance = new DB($config);
        }
        return self::$instance;
    }

    /**
     * DB constructor.
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $dsn = $config['driver'] . ':dbname=' . $config['dbname'] . ';host=' . $config['host'];
        $user = $config['user'];
        $password = $config['password'];
        $this->pdo = new PDO($dsn, $user, $password);
    }

    /**
     * @param $sql
     * @return PDOStatement
     */
    public function query($sql)
    {
        $stat = $this->pdo->query($sql, PDO::FETCH_ASSOC);
        return $stat->fetchAll();
    }

    /**
     * @param $sql
     * @return PDOStatement
     */
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

}
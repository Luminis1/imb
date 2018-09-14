<?php

namespace vendor\Db;
use PDO;

class Db
{
    private static $instance = null;
    public $_db;
    
    public static function getInstance()
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    private function __construct()
    {
        $charset = 'utf8';
        $ini = parse_ini_file( $_SERVER['DOCUMENT_ROOT'] . '/config/config.ini');
        $dsn = 'mysql:dbname=' . $ini['db_name'] . ';host=' . $ini['db_localhost'] . ';charset='. $charset.'';
        $user = $ini['db_user'] ;
        $password = $ini['db_password'] ;
        $opt = array(
            PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false
        );
        try {
            $this->_db = new PDO($dsn, $user, $password, $opt);
        }
        catch (PDOException $e) { die('Подключение не удалось: ' . $e->getMessage()); }
//
        
    }
    
    public function query($sql)
    {
        if ($result = $this->_db->query($sql)) {
            return $result;
        }else{
            die('query is failed');
        }
    }
    public function queryParam($sql, $param)
    {
        $prep = $this->_db->prepare($sql);
        $prep->bindValue(':datetime', $param);
        $prep->execute();
        $result = $prep->fetchAll();

        return $result;
    }
    
    private function __clone(){}
    
}
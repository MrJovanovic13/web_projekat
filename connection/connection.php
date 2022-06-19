<?php

class Database
{
    private $host;
    private $user;
    private $pass;
    private $db;
    public $mysqli;

    public function __construct()
    {
        $this->db_connect();
    }

    private function db_connect()
    {
        $this->host = 'prodajahardvera.mysql.database.azure.com';
        $this->user = 'prodajahardvera';
        $this->pass = 'Mrjovanovic$';
        $this->db = 'prodajahardvera';

        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
        return $this->mysqli;
    }

    public function prepareQuery($q) {
        return $this->mysqli->prepare($q);
    }

    public function executeQuery($sql)
    {
        $result = $this->mysqli->query($sql);
        return $result;
    }

    public function lastInsertedId()
    {
        return $this->mysqli->insert_id;
    }
}

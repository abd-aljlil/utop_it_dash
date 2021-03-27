<?php


class DB
{
    public $db;
    // Constants of connection
    private  $host="localhost";
    private  $username="utopians_utopians";
    private  $password="YzxvExlrqOy20@";
    private  $dbname="utopians_edu";
    public function __construct()
    {
        $this->db=mysqli_connect($this->host,$this->username,$this->password,$this->dbname);
    }

    public function query($sql)
    {
        $this->db->set_charset("utf8");
        return $this->db->query($sql);
    }
}
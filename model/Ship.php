<?php

class Ship
{
    protected $db;
    public function __construct()
    {
        $this->db =  conectDB();
    }
    public function getAllShipping()
    {
        $sql = 'select * from ship ';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

<?php

class Profile
{
    protected $db;

    public function __construct()
    {
        $this->db = conectDB();
    }


    public function updateUser($name, $email,$phone,$gender, $address)
    {
        $sql = 'update users set name=?,email=?,phone=?,gender=?,address=? WHERE id =?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $email,$phone,$gender, $address,$_SESSION['user']['id'] ]);
    }

    public function getUserById($id){
        $sql = 'SELECT * FROM users WHERE id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
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
    public function getPassword()
    {
        $sql = 'select password from users where id=?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_SESSION['user']['id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($newPassword)
    {
        $hash_new_password = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = 'update users set password = ? where id = ?';
        $stmt= $this->db->prepare($sql);
        return $stmt->execute([$hash_new_password,$_SESSION['user']['id']]);
    }
    
    public function updateAvatar($avatar){
        $sql = ' update users set avatar = ? where id = ?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$avatar,$_SESSION['user']['id']]);
    }
}
<?php
require_once "../includes/conectDB.php";
class User
{
    protected $db;
    public function __construct()
    {
        $this->db =  conectDB();
    }

    public function registerAdmin($name, $email, $password)
    {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(name,email,password,role_id) VALUES(?,?,?,2)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $email, $hash_password]);
    }

    public function register($name, $email, $password)
    {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(name,email,password,role_id) VALUES(?,?,?,1)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $email, $hash_password]);
    }

    public function login($email, $password)
    {
        // Truy vấn người dùng dựa trên email
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);

        // Lấy thông tin người dùng
        $user = $stmt->fetch();

        // Kiểm tra nếu tìm thấy người dùng và mật khẩu khớp
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Đăng nhập thành công, trả về thông tin người dùng
        }

        return false; // Đăng nhập thất bại
    }


    public function getUser()
    {
        $sql = "SELECT * FROM users where email='kien18092004@gmail.com'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
}

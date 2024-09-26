<?php

require_once "../model/User.php";
class UserController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
                $_SESSION['message'] = "Vui lòng điền đầy đủ thông tin";
            } else {
                $register = $this->userModel->register($_POST['name'], $_POST['email'], $_POST['password']);
                if ($register) {
                    header("Location: index.php?act=login");
                    $_SESSION['message'] = "Đăng ký thành công . Vui lòng đăng nhập";
                    exit();
                } else {
                    $_SESSION['message'] = "Đăng ký thất bại . Vui lòng kiểm tra thông tin ";
                }
            }
        }
    }
 
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            // Kiểm tra xem email và password có được nhập hay không
            if (empty($_POST['email']) || empty($_POST['password'])) {
                // Nếu không nhập thông tin, đưa ra thông báo
                $_SESSION['message'] = "Vui lòng nhập đầy đủ email và mật khẩu.";
            } else {
                try {
                    // Gọi phương thức login từ model để kiểm tra người dùng
                    $user = $this->userModel->login($_POST['email'], $_POST['password']);
                    if ($user) {
                        // Nếu đăng nhập thành công
                        $_SESSION['user'] = $user; // Lưu thông tin người dùng vào session
                        $_SESSION['message'] = "Đăng nhập thành công";
                        header("Location: index.php?act=index"); // Chuyển hướng về trang chủ
                        exit(); // Dừng thực thi sau khi chuyển hướng
                    } else {
                        // Nếu đăng nhập thất bại (email hoặc mật khẩu không chính xác)
                        $_SESSION['message'] = "Đăng nhập thất bại. Vui lòng kiểm tra email hoặc mật khẩu.";
                    }
                } catch (\Throwable $th) {
                    // Bắt lỗi từ hệ thống và trả về thông báo lỗi
                    $_SESSION['message'] = "Đăng nhập thất bại: " . $th->getMessage();
                }
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header("Location: index.php?act=login");
    }
}

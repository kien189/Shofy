<?php
require_once "../model/User.php";
class AuthAdminController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_admin'])) {
            $loginAdmin = $this->userModel->login($_POST['email'], $_POST['password']);
            if ($loginAdmin) {
                $_SESSION['user_admin'] = $loginAdmin;
                if ($this->isAdmin()) {
                    $_SESSION['success'] = "Đăng nhập thành công .";
                    header("Location:index.php?act=dashboard");
                    exit();
                } else {
                    header("Location:index.php?act=admin");
                    $_SESSION['error'] = "Bạn không có quyền truy cập.";
                    exit();
                }
            } else {
                $_SESSION['error'] = "Đăng nhập thất bị. Vui lòng kiểm tra lại.";
            }
        }
    }



    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_admin'])) {
            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin !";
            } else {
                $registerAdmin = $this->userModel->registerAdmin($_POST['name'], $_POST['email'], $_POST['password']);
                if ($registerAdmin) {
                    header("Location:index.php?act=admin");
                    $_SESSION['success'] = "Đăng ký thành công . Vui lòng đăng nhập";
                } else {
                    $_SESSION['error'] = "Đăng ký thất bị. Vui lòng kiểm tra lại thông tin!";
                }
            }
        }
    }

    public function isAdmin()
    {
        // Kiểm tra nếu người dùng đã đăng nhập và khóa 'role_id' có tồn tại trong $_SESSION['user_admin']
        // và giá trị của 'role_id' là 2 (tức là admin)
        return isset($_SESSION['user_admin']) && isset($_SESSION['user_admin']['role_id']) && $_SESSION['user_admin']['role_id'] == 2;
    }



    public function middleware()
    {
        if (!$this->isAdmin()) {
            $_SESSION['error'] = "Bạn không có quyền truy cập .";
            header("Location: index.php?act=admin");
            exit();
        }
    }
    public function logout()
    {
        unset($_SESSION['user_admin']);
        $_SESSION['success'] = "Đăng xuất thành công .";
        header("Location: index.php?act=admin");
        exit();
    }
}

<?php
require_once "../model/Profile.php";

class ProfileController extends Profile
{
//     public function index()
//     {
// //        echo '<pre>';
// //        print_r($_SESSION['user']);
// //        echo '<pre>';
// //
//         require_once '../views/client/profile/profile.php';
//     }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateProfile'])) {
            $user = $this->updateUser($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['gender'], $_POST['address']);
            if ($user) {
                $_SESSION['user'] = $this->getUserById($_SESSION['user']['id']);
                $_SESSION['success'] = 'Cập nhật thông tin thành công';
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $_SESSION['error'] = 'Đã có lỗi xảy ra vui lòng thử lại ';
                header('location:' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}
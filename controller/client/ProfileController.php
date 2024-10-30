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

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changePassword'])) {
            $passwordData = $this->getPassword();
            $hashedPassword = $passwordData['password'];
            // echo '<pre>';
            // print_r($hashedPassword);
            // echo '<pre>';
            // Kiểm tra xem các trường nhập có bị trống không
            if (empty($_POST['newPassword']) || empty($_POST['currentPassword']) || empty($_POST['confirmPassword'])) {
                $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin.';
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            // Kiểm tra mật khẩu cũ có đúng không
            if (!password_verify($_POST['currentPassword'], $hashedPassword)) {
                $_SESSION['error'] = 'Mật khẩu cũ không đúng';
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            // Kiểm tra xem mật khẩu mới và xác nhận mật khẩu có khớp không
            if ($_POST['newPassword'] !== $_POST['confirmPassword']) {
                $_SESSION['error'] = "Mật khẩu mới và xác nhận mật khẩu không khớp.";
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            // Thực hiện thay đổi mật khẩu nếu tất cả kiểm tra đều hợp lệ
            if ($this->updatePassword($_POST['newPassword'])) {
                $_SESSION['success'] = 'Cập nhật mật khẩu thành công';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra, vui lòng thử lại.';
            }

            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function updateAvatarUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['avatar'])) {
            $currentUser = $this->getUserById($_SESSION['user']['id']);

            // Kiểm tra nếu có ảnh cũ và xóa ảnh cũ
            if (!empty($currentUser['avatar'])) {
                $oldAvatarPath = "./images/user/" . $currentUser['avatar'];
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath); // Xóa ảnh cũ
                }
            } 
                $file = $_FILES['avatar'];
                $fileName = basename($file['name']);
                $images = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\-_\.]+/', '-', $fileName); // Biểu thức chính quy đúng cú pháp
                if (move_uploaded_file($file['tmp_name'], "./images/user/" .  $images)) {
                    $avatar = $this->updateAvatar($images);
                    if ($avatar) {
                        $_SESSION['user'] = $this->getUserById($_SESSION['user']['id']);
                        $_SESSION['success'] = 'Cập nhật ảnh đại diện thành';
                    }
                } else {
                    $_SESSION['error'] = 'Có lỗi xảy ra, vui lòng thử lại.';
                }
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            
        }
    }
}

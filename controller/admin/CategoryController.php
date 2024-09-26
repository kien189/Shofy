<?php
require_once "../model/Category.php";
class CategoryController extends Category
{
    public function createCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {

            if (empty($_POST['name']) || empty($_POST['description'])) {
                $_SESSION['message'] = "Vui lòng điền đầy đủ thông tin !";
                header("Location:index.php?act=add_category");
                exit();
            } else {
                $file = $_FILES['image'];
                $images = $file['name'];
                var_dump($images);
                if (move_uploaded_file($file['tmp_name'], "./images/category/" .  $images)) {
                    $addCategory = $this->addCategory($_POST['name'], $_POST['description'], $images);
                    $_SESSION['message'] = "Thêm danh mục thành công!";
                    header("Location:index.php?act=category");
                    exit();
                } else {
                    $_SESSION['message'] = "Đã xảy ra lỗi. Vui lòng thử lại!";
                }
            }
        }
    }

    public function getCategory()
    {
        $listCategory = $this->getAllCategory();
        if ($listCategory) {
            return $listCategory;
        } else {
            $_SESSION['message'] = "Danh mục trống !";
        }
    }

    public function editCategory($id)
    {
        $getCategoryById = $this->getCategoryById($_GET['id']);
        if ($getCategoryById) {
            return  $getCategoryById;
        } else {
            $_SESSION['message'] = 'Không tồn tại danh mục ';
            return null;
        }
    }


    public function updateCate()
    {
        if ($_SERVER['REQUEST_METHOD'] = "POST" && isset($_POST['update_category'])) {

            $file = $_FILES['image'];
            $fileName = basename($file['name']);
            $image = uniqid() . '-' . preg_replace('/![^A-Za-z0-9\-_\.]+!/', '-', $fileName);
            if ($file['size'] > 0) {
                move_uploaded_file($file['tmp_name'], "./images/category/" .  $image);
                if (!empty($_POST['oldImage']) && file_exists("./images/category/" .  $_POST['oldImage'])) {
                    unlink("./images/category/" .  $_POST['oldImage']);
                }
            } else {
                $image = $_POST['oldImage'];
            }

            $updateCate = $this->updateCategory($_GET['id'], $_POST['name'], $_POST['description'], $image);
            $_SESSION['message'] = "Cập nhật thành công !.";
            header("location:index.php?act=category");
            exit();
        } else {
            $_SESSION['message'] = "Cập nhật không thành công . Vui lòng thử lại.";
        }
    }

    public function deleteCate (){
        try {
           $this->deleteCategory($_GET['id']);
           $_SESSION['message'] = "Xoá danh mục thành công .";
           header("location: index.php?act=category");
           exit();
        } catch (\Throwable $th) {
            $_SESSION['message'] = "Xóa danh mục thất bại .Vui lòng thử lại .";
        }
    }
}

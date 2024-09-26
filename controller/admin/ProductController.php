<?php
require_once "../model/Product.php";

class ProductController extends Product
{

    public function getAllColor()
    {
        return $color = $this->getColorAll();
    }
    public function getAllSize()
    {
        return $size = $this->getSizeAll();
    }

    public function addProducts()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
            $file = $_FILES['image'];
            $fileName = basename($file['name']);
            $images = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\-_\.]+/', '-', $fileName); // Biểu thức chính quy đúng cú pháp
            if (move_uploaded_file($file['tmp_name'], "./images/product/" .  $images)) {
                $addProduct = $this->addProduct($_POST['name'], $images, $_POST['priceProduct'], $_POST['category_id'], $_POST['description']);
                if ($addProduct) {
                    $product_id = $this->getLastInsertId();
                    if (isset($_POST['size']) && isset($_POST['color'])) {
                        // Giả định rằng tất cả các mảng đều có cùng số lượng phần tử
                        foreach ($_POST['size'] as $index => $size) {
                            $addProductVariant = $this->addProductVariant($product_id,$_POST['color'][$index], $size,  $_POST['quantity'][$index], $_POST['price'][$index], $_POST['salePrice'][$index]);
                        }
                    }
                    if (!empty($_FILES['images']['name'][0])) {
                        $file = $_FILES['images'];
                        for ($i = 0; $i < count($file['name']); $i++) {
                            $fileName = basename($file['name'][$i]);
                            $imageArray = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\-_\.]+/', '-', $fileName);
                            move_uploaded_file($file['tmp_name'][$i], "./images/productGalery/" .  $imageArray);
                            $this->addProductImage($product_id, $imageArray);
                        }
                    }

                    $_SESSION['message'] = "Sản phẩm đã được thêm thành công!";
                    header('Location: index.php?act=product');
                    exit();
                } else {
                    $_SESSION['message'] = "Sản phẩm không thêm. Vui lòng thử lại!";
                    exit();
                }
            } else {
                $_SESSION['message'] = "Đã có lỗi xảy ra vui lòng thực hiện lại ";
                exit();
            }
        }
    }

    // public function addProducts()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    //         $file = $_FILES['image'];
    //         $fileName = basename($file['name']);
    //         $images = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\-_\.]+/', '-', $fileName); // Biểu thức chính quy đúng cú pháp
    //         if (move_uploaded_file($file['tmp_name'], "./images/product/" .  $images)) {
    //             $addProduct = $this->addProduct($_POST['name'], $images, $_POST['priceProduct'], $_POST['category_id'], $_POST['description']);
    //             if ($addProduct) {
    //                 $product_id = $this->getLastInsertId();
    //                 if (isset($_POST['color']) && isset($_POST['size'])) {
    //                     foreach ($_POST['size'] as $index => $sizeArray) {
    //                         foreach ($_POST['color'] as $colorId) {
    //                             $addProductVariant = $this->addProductVariant($product_id, $colorId, $sizeArray, $_POST['quantity'][$index], $_POST['price'][$index], $_POST['sale_price'][$index]);
    //                         }
    //                     }
    //                 }

    //                 if (!empty($_FILES['images']['name'][0])) {
    //                     $file = $_FILES['images'];
    //                     for ($i = 0; $i < count($file['name']); $i++) {
    //                         $fileName = basename($file['name'][$i]);
    //                         $imageArray = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\-_\.]+/', '-', $fileName);
    //                         move_uploaded_file($file['tmp_name'][$i], "./images/productGalery/" .  $imageArray);
    //                         $this->addProductImage($product_id, $imageArray);
    //                     }
    //                 }

    //                 $_SESSION['message'] = "Sản phẩm đã được thêm thành công!";
    //                 header('Location: index.php?act=product');
    //                 exit();
    //             } else {
    //                 $_SESSION['message'] = "Sản phẩm không thêm. Vui lòng thử lại!";
    //                 exit();
    //             }
    //         } else {
    //             $_SESSION['message'] = "Đã có lỗi xảy ra vui lòng thực hiện lại ";
    //             exit();
    //         }
    //     }
    // }
}

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
                            $addProductVariant = $this->addProductVariant($product_id, $_POST['color'][$index], $size,  $_POST['quantity'][$index], $_POST['price'][$index], $_POST['salePrice'][$index]);
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

                    $_SESSION['success'] = "Sản phẩm đã được thêm thành công!";
                    header('Location: index.php?act=product');
                    exit();
                } else {
                    $_SESSION['error'] = "Sản phẩm không thêm. Vui lòng thử lại!";
                    exit();
                }
            } else {
                $_SESSION['error'] = "Đã có lỗi xảy ra vui lòng thực hiện lại ";
                exit();
            }
        }
    }

    public function getProductAll()
    {
        return $this->getAllProduct();
    }

    public function getProductById($product_id)
    {
        // Lấy thông tin sản phẩm
        $productInfo = $this->getProductInfo($product_id);
        // echo '<pre>';
        // print_r($productInfo);
        // echo '</pre>';
        // Nếu không tìm thấy sản phẩm, trả về null
        if (!$productInfo) {
            return null;
        }

        // Lấy danh sách ảnh của sản phẩm
        $productGallery = $this->getProductGallery($product_id);
        // echo '<pre>';
        // print_r($productGallery);
        // echo '</pre>';
        // Lấy danh sách các biến thể của sản phẩm
        $productVariants = $this->getProductVariants($product_id);
        // echo '<pre>';
        // print_r($productVariants);
        // echo '</pre>';
        // Kết hợp các thông tin lại thành một mảng
        $product = [
            'product_info' => $productInfo,
            'product_gallery' => $productGallery,
            'product_variants' => $productVariants
        ];

        return $product;
    }

    public function updateProducts()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {
            // Kiểm tra và xử lý ảnh mới
            $file = $_FILES['image'];
            $fileName = basename($file['name']);

            // Nếu có ảnh mới
            if ($file['size'] > 0) {
                $images = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\-_\.]+/', '-', $fileName); // Tạo tên ảnh mới
                if (move_uploaded_file($file['tmp_name'], "./images/product/" .  $images)) {
                    // Xóa ảnh cũ nếu tồn tại
                    if (!empty($_POST['oldImage']) && file_exists("./images/product/" .  $_POST['oldImage'])) {
                        unlink("./images/product/" . $_POST['oldImage']);
                    }
                }
            } else {
                $images = $_POST['oldImage'];
            }

            // Cập nhật thông tin sản phẩm
            $updateProduct = $this->updateProduct($_GET['product_id'], $_POST['name'], $images, $_POST['priceProduct'], $_POST['category_id'], $_POST['description']);

            if ($updateProduct) {
                $product_id = $_GET['product_id']; // Lấy ID sản phẩm trực tiếp từ URL

                // Cập nhật biến thể sản phẩm
                // Cập nhật và thêm mới biến thể sản phẩm
                if (isset($_POST['size']) && isset($_POST['color'])) {
                    foreach ($_POST['size'] as $index => $size) {
                        // Kiểm tra xem biến thể này đã tồn tại chưa
                        if (isset($_POST['product_variant_id'][$index]) && !empty($_POST['product_variant_id'][$index])) {
                            // Cập nhật biến thể hiện có
                            $this->updateProductVariant(
                                $_POST['product_variant_id'][$index], // ID biến thể cần cập nhật
                                $product_id, // ID sản phẩm
                                $_POST['color'][$index], // Mã màu
                                $size, // Mã kích thước
                                $_POST['quantity'][$index], // Số lượng
                                $_POST['price'][$index], // Giá
                                $_POST['salePrice'][$index] // Giá giảm
                            );
                        } else {
                            // Thêm mới biến thể nếu không có product_variant_id
                            $this->addProductVariant(
                                $product_id,
                                $_POST['color'][$index],
                                $size,
                                $_POST['quantity'][$index],
                                $_POST['price'][$index],
                                $_POST['salePrice'][$index]
                            );
                        }
                    }
                }

                // Cập nhật ảnh thư viện sản phẩm (nếu có)
                if (!empty($_FILES['images']['name'][0])) {
                    $file = $_FILES['images'];
                    for ($i = 0; $i < count($file['name']); $i++) {
                        $fileName = basename($file['name'][$i]);
                        $imageArray = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\-_\.]+/', '-', $fileName);
                        move_uploaded_file($file['tmp_name'][$i], "./images/productGalery/" . $imageArray);
                        $this->addProductImage($product_id, $imageArray);
                    }
                } else {
                    $imageArray = $_POST['oldImages'];
                }

                // Đặt thông báo thành công và chuyển hướng
                $_SESSION['success'] = "Cập nhật sản phẩm thành công!";
                header('Location: index.php?act=product');
                exit();
            } else {
                // Đặt thông báo lỗi và chuyển hướng
                $_SESSION['error'] = "Cập nhật sản phẩm thất bại. Vui lòng thử lại!";
                header('Location: index.php?act=product');
                exit();
            }
        }
    }

    public function deleteProductAll()
    {
        try {
            // Bắt đầu một transaction để đảm bảo tính toàn vẹn
            $this->db->beginTransaction();
            // Xóa các biến thể sản phẩm
            $this->deleteProductVariant($_GET['product_id']);
            // Xóa các ảnh thư viện sản phẩm
            $this->deleteProductGallery($_GET['product_id']);
            // Xóa sản phẩm chính
            $this->deleteProduct($_GET['product_id']);
            // Commit transaction nếu mọi thứ thành công
            $this->db->commit();
            $_SESSION['success'] = "Sản phẩm đã được xóa thành công!";
            header('Location: index.php?act=product');
        } catch (\Exception $e) {
            // Rollback nếu có lỗi
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            $_SESSION['error'] = "Đã xảy ra lỗi khi xóa sản phẩm: " . $e->getMessage();
        }
    }







































































    public function deleteVariantsId()
    {
        try {
            $this->deleteVariantsById($_GET['product_variant_id']);
            $_SESSION['success'] = "Xoá bộ sản phẩm thể thay đổi !";
            header("location: index.php?act=product");
            exit();
        } catch (\Throwable $th) {
            $_SESSION['error'] = "Xóa bộ sản phẩm thể thay đổi !";
            header("location: index.php?act=product");
            var_dump($th->getMessage());
        }
    }
}

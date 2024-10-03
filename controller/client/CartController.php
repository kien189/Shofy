<?php
require_once "../model/Cart.php";

class CartController extends Cart
{
    public function AddToCarts()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addToCart'])) {
            $this->addCart();
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buyNow'])) {
            $this->buyNows();
        }
    }


    public function addCart()
    {
        try {
            if (empty($_POST['variant_id']) || empty($_POST['quantity'])) {
                $_SESSION['error'] = "Vui lòng chọn size và màu ";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            $chekCarts = $this->checkCart();
            if ($chekCarts) {
                $quantity = $chekCarts['quantity'] + $_POST['quantity'];
                $updateCart = $this->updateCart($_POST['user_id'], $_POST['product_id'], $_POST['variant_id'], $quantity);
                $_SESSION['success'] = "Cập nhật giỏ hàng thành công";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $addToCart = $this->addToCart($_POST['user_id'], $_POST['product_id'], $_POST['variant_id'], $_POST['quantity']);
                $_SESSION['success'] = "Thêm vào giỏ hàng thành công";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage(); // Ghi lỗi vào session
            header('Location: ' . $_SERVER['HTTP_REFERER']); // Quay lại trang trước đó
            exit();
        }
    }

    public function buyNows()
    {
        try {
            if (empty($_POST['variant_id']) || empty($_POST['quantity'])) {
                $_SESSION['error'] = "Vui lòng chọn size và màu ";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            $chekCarts = $this->checkCart(); // Thực thi checkCart

            if ($chekCarts) {
                $quantity = $chekCarts['quantity'] + $_POST['quantity'];
                $updateCart = $this->updateCart($_POST['user_id'], $_POST['product_id'], $_POST['variant_id'], $quantity);
                // $getDetailProduct = $this->getDetailProduct($chekCarts['product_id']);
                // $_SESSION['getDetailProduct'] = $getDetailProduct;
                header("Location: index.php?act=buyNow&id=".$chekCarts['id']."&product_id=".$chekCarts['product_id']);
                exit();
            } else {
                $byNows = $this->byNow($_POST['user_id'], $_POST['product_id'], $_POST['variant_id'], $_POST['quantity']);
                header("Location: index.php?act=buyNow&id=".$byNows['id']."&product_id=".$byNows['product_id']);
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage(); // Ghi lỗi vào session
            header('Location: ' . $_SERVER['HTTP_REFERER']); // Quay lại trang trước đó
            exit();
        }
    }
}

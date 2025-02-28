<?php
require_once "../model/Cart.php";
require_once "../model/Coupon.php";
require_once "../includes/CartProvider.php";
class CartController extends Cart
{
    // protected $coupon;
    // public function __construct()
    // {
    //     $this->coupon = new Coupon();
    // }
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
                header("Location: index.php?act=buyNow&id=" . $chekCarts['id'] . "&product_id=" . $chekCarts['product_id']);
                exit();
            } else {
                $byNows = $this->byNow($_POST['user_id'], $_POST['product_id'], $_POST['variant_id'], $_POST['quantity']);
                header("Location: index.php?act=buyNow&id=" . $byNows['id'] . "&product_id=" . $byNows['product_id']);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage(); // Ghi lỗi vào session
            // header('Location: ' . $_SERVER['HTTP_REFERER']); // Quay lại trang trước đó
            exit();
        }
    }

    public function getCarts()
    {
        $cartProvider = CartProvider::getInstance();
        $cartItems = $cartProvider->getCartItems();
        $total = $cartProvider->sum($cartItems);
        include "../views/client/cart/detailCart.php";
    }


    public function updateCarts()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateCart'])) {
            if (isset($_POST['quantity'])) {
                foreach ($_POST['quantity'] as $cartId => $quantity) {
                    // Gọi phương thức cập nhật giỏ hàng với tham số cartId và quantity
                    $this->updateCartById($cartId, $quantity);
                }
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                $_SESSION['success'] = "Cập nhật giỏ hàng thành công";
                exit();
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['applyCoupon'])) {
            $this->addCoupon();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            $_SESSION['success'] = "Áp dụng mã giảm giá thành công";
            exit();
        }
    }


    public function deleleCarts()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cartId'])) {
            $this->deleteCart($_GET['cartId']);
            $_SESSION['success'] = "Xóa sản phẩm thành công";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function addCoupon()
    {
        $coupon = $this->getCouponByCode($_POST['coupon_code']);
        if (!$coupon) {
            $_SESSION['error'] = 'Mã giảm giá không tồn tại';
            header("Location:" . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if (isset($_SESSION['coupon'])) {
            $_SESSION['error'] = 'Chỉ được sử dụng coupon 1 lần ';
            header("Location:" . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['coupon'] = $coupon;

            $totalCart = $this->handleCoupon($coupon, $_POST['total']);
            $_SESSION['totalCart'] = $totalCart;
        }
    }
    public function handleCoupon($coupon, $total)
    {

        if ($coupon['type'] == 'Percentage') {
            $totalCart = ($total * $coupon['coupon_value'] / 100);
        } elseif ($coupon['type'] == 'Fixed Amount') {
            $totalCart = $coupon['coupon_value'];
        }
        return $totalCart;
    }

    public function ship(){
        
    }
}

<?php

require_once "../model/Order.php";
require_once "../includes/cartProvider.php";
require_once "../controller/client/PaymentController.php";
class OrderController extends Order
{
    protected $paymentMethod;

    public function __construct(){
        $this->paymentMethod = new PaymentController();
    }


    public function Orders()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
                // echo '<pre>';
                // print_r($_POST);
                // echo '</pre>';
                $cartProvider = CartProvider::getInstance();
                $getCheckout = $cartProvider->getCartItems();
                $orderDetails = $this->addOrderDetail($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_SESSION['user']['id'], $_POST['amout'], $_POST['note']);
                if ($orderDetails) {
                    $order_id = $this->getLastInsertId();
                    if (is_array($getCheckout)) {
                        foreach ($getCheckout as  $item) {
                            $order = $this->addOrder($_SESSION['user']['id'], $item['product_id'], $item['variant_id'], $item['cart_quantity'], $order_id);
                            $this->deleteCart($item['cart_id']);
                        }
                        header('Location: index.php');
                        $_SESSION['success'] = "Đặt hàng nhiều đơn thành công!";
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "Đặt hàng thất bại!";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['momo'])) {
                $this->paymentMethod->momoPayment();
                exit();
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vnpay'])) {
               $this->paymentMethod->vnpayPayment();
               exit();
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function checkout()
    {
        $cartProvider = CartProvider::getInstance();
        $getCheckout = $cartProvider->getCartItems();

        // echo '<pre>';
        // print_r($getCheckout);
        // echo '</pre>';
        $total = $cartProvider->sum($getCheckout);
        require_once "../views/client/checkout/checkout.php";
    }
}

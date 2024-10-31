<?php

require_once "../model/Order.php";
require_once "../model/Ship.php";
require_once "../includes/cartProvider.php";
require_once "../controller/client/PaymentController.php";
class OrderController
{
    protected $paymentMethod;
    protected $orders;
    protected $ship;
    public function __construct()
    {
        $this->orders = new Order();
        $this->paymentMethod = new PaymentController();
        $this->ship = new Ship();
    }


    public function Orders()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
                // echo '<pre>';
                // print_r($_POST);
                // echo '<pre>';
                $this->order();
                unset($_SESSION['coupon']);
                unset($_SESSION['totalCart']);
                $_SESSION['success'] = "Đặt hàng nhiều đơn thành công!";
                header('Location:/');
                exit();
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['momo'])) {
                $this->order();
                $this->paymentMethod->momoPayment();
                unset($_SESSION['coupon']);
                unset($_SESSION['totalCart']);
                exit();
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vnpay'])) {
                $this->order();
                $this->paymentMethod->vnpayPayment();
                exit();
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function order()
    {
        $cartProvider = CartProvider::getInstance();
        $getCheckout = $cartProvider->getCartItems();
        $orderDetails = $this->orders->addOrderDetail($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_SESSION['user']['id'], $_POST['amount'], $_POST['note'], $_POST['shipping_id'],$_POST['coupon_id']);//,$_POST['coupon_id'], $_POST['shipping_id']
        if ($orderDetails) {
            $order_id = $this->orders->getLastInsertId();
            if (is_array($getCheckout)) {
                foreach ($getCheckout as  $item) {
                    $order = $this->orders->addOrder($_SESSION['user']['id'], $item['product_id'], $item['variant_id'], $item['cart_quantity'], $order_id);
                    $this->orders->deleteCart($item['cart_id']);
                }
            }
        }
    }

    public function vnpayReturn()
    {
        unset($_SESSION['coupon']);
        unset($_SESSION['totalCart']);
        $_SESSION['success'] = "Đặt hàng thành công!";
        header('Location:index.php ');
        exit();
    }

    // public function momoReturn()
    // {
    //     $data = $_REQUEST;
    //     if (isset($data['partnerCode'])) {
    //         $this->order();
    //         exit();
    //     }
    // }

    public function checkout()
    {
        $cartProvider = CartProvider::getInstance();
        $getCheckout = $cartProvider->getCartItems();
        $shipping = $this->ship->getAllShipping();
        // echo '<pre>';
        // print_r($shipping);
        // echo '</pre>';
        $total = $cartProvider->sum($getCheckout);
        require_once "../views/client/checkout/checkout.php";
    }

    public function myOrder()
    {
        $orders = $this->orders->getOrderByUser();
        // echo '<pre>';
        // print_r($orders);
        // echo '<pre>';
        return $orders;
    }

    public function trackOrder()
    {
        $orders = $this->orders->getOrderById();
        $orderList = $this->orders->getOrderProduct();
        $coupon = $this->handleCoupon($orders,$orders['amount']);
        // echo '<pre>';
        // print_r($orders);
        // echo '<pre>';
        require_once '../views/client/track_order/track_order.php';
    }
    public function handleCoupon($coupon, $total)
    {

        if ($coupon['type'] == 'Percentage') {
            $totalCart = ($total * $coupon['coupon_value'] / 100);
        } elseif ($coupon['type'] == 'Fixed Amount') {
            $totalCart = $coupon['coupon_value'];
        }
        return $totalCart ?? 0 ;
    }

    
}

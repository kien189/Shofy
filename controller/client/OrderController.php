<?php

require_once "../model/Order.php";

class OrderController extends Order
{

    public function Orders()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
                echo '<pre>';
                print_r($_POST);
                echo '</pre>';
                $orderDetails = $this->addOrderDetail($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_SESSION['user']['id'], $_POST['amout'], $_POST['note']);
                if ($orderDetails) {
                    $order_id = $this->getLastInsertId();
                    $order = $this->addOrder($_SESSION['user']['id'], $_POST['product_id'], $_POST['variant_id'], $_POST['quantity'], $order_id);
                    $this->deleteCart();
                    header('Location: index.php');
                    $_SESSION['success'] = "Đặt hàng thành công!";
                } else {
                    $_SESSION['error'] = "Đặt hàng thất bại!";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}

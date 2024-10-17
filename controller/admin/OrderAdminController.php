<?php
require_once "../model/Order.php";
class OrderAdminController extends Order
{
    public function index()
    {
        $getOrders = $this->getAllOrder();
        require_once "../views/admin/orders/orderList.php";
    }

    public function detail()
    {

        $getOrderById = $this->getOrderById();
        $product = $this->getOrderProduct();
        // echo '<pre>';
        // print_r($product);
        // echo '</pre>';
        require_once "../views/admin/orders/orderDetail.php";
    }
    public function updateOrders()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['updateOrder'])) {

            $updateOrder = $this->updateOrder($_POST['id'], $_POST['status']);
            $_SESSION['success'] = "Cập nhật đơn hàng thành công";
            header("location:" . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['error'] = "Cập nhật đơn hàng thất bại";
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function removeOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET" ) {
            $deleteOrder = $this->deleteOrder();
            $_SESSION['success'] = "Xoá đơn hàng thành công";
            header("location:" . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['error'] = "Xoá đơn hàng thất bại";
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}

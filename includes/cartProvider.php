<?php

require_once "../model/Cart.php";
class CartProvider
{
    protected $carts;

    private static $instance = null; //Biến tĩnh để giữ thể hiện duy nhất của class 
    private $cateItems = []; // Mảng lưu trữ các mục trong giỏ hàng 

    private function __construct()
    {
        $this->carts = new Cart();
        //Nếu giỏ hàng đã được lưu trong session , khởi tạo từ session 
        if (isset($_SESSION['cartItems'])) {
            $this->cateItems = $_SESSION['cartItems'];
        }
    }

    //Phương thức lấy instance của Singleton
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new CartProvider();
        }
        return self::$instance;
    }


    //Lấy danh sách các sản phẩm trong giỏ hàng 
    public function getCartItems()
    {
        return  $this->carts->getAllCarts();
    }
    function sum($carts)
    {
        $total = 0;
        foreach ($carts as $item) {
            $total += $item['variant_price'] * $item['cart_quantity']; // Tính giá trị cho từng mục
        }
        return $total;
    }


    //Cập nhật giỏ hàng từ db 
    // public function updateCarts()
    // {
    //     echo "updateCarts";
    //     // $this->cateItems = $this->getAllCarts(); // Lấy dữ liệu từ db 
    //     // $_SESSION['cartItems'] = $this->cateItems; //Cập nhật giỏ hàng vào session
    // }

   
}

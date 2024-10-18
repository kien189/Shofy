<?php

// Nhúng các mô hình cần thiết cho giỏ hàng và yêu thích
require_once "../model/Cart.php";
require_once "../model/Favorite.php";

class CartProvider
{
    protected $carts; // Biến lưu trữ đối tượng giỏ hàng
    protected $favorite; // Biến lưu trữ đối tượng yêu thích

    private static $instance = null; // Biến tĩnh để giữ thể hiện duy nhất của class (Singleton)
    private $cateItems = []; // Mảng lưu trữ các mục trong giỏ hàng
    private $favoriteItems = []; // Mảng lưu trữ các mục yêu thích

    // Hàm khởi tạo (Constructor) - được gọi khi tạo thể hiện mới của lớp
    private function __construct()
    {
        $this->carts = new Cart(); // Khởi tạo đối tượng Cart
        $this->favorite = new Favorite(); // Khởi tạo đối tượng Favorite

        // Nếu giỏ hàng đã được lưu trong session, khởi tạo từ session
        if (isset($_SESSION['cartItems'])) {
            $this->cateItems = $_SESSION['cartItems']; // Lưu các mục giỏ hàng vào biến cateItems
        }
    }

    // Phương thức tĩnh để lấy instance của Singleton
    public static function getInstance()
    {
        // Kiểm tra xem đã có thể hiện nào chưa
        if (self::$instance == null) {
            // Nếu chưa, tạo mới thể hiện của CartProvider
            self::$instance = new CartProvider();
        }
        return self::$instance; // Trả về thể hiện duy nhất
    }

    // Phương thức để lấy danh sách các sản phẩm trong giỏ hàng
    public function getCartItems()
    {
        return $this->carts->getAllCarts(); // Gọi phương thức getAllCarts từ đối tượng carts
    }

    // Phương thức để lấy danh sách các sản phẩm yêu thích
    public function getFavoriteItems()
    {
        return $this->favorite->listFavorite(); // Gọi phương thức listFavorite từ đối tượng favorite
    }

    // Hàm tính tổng giá trị của các sản phẩm trong giỏ hàng
    function sum($carts)
    {
        $total = 0; // Khởi tạo biến tổng
        // Duyệt qua từng mục trong giỏ hàng
        foreach ($carts as $item) {
            // Tính giá trị cho từng mục (giá biến thể * số lượng trong giỏ hàng) và cộng vào tổng
            $total += $item['variant_price'] * $item['cart_quantity'];
        }
        return $total; // Trả về tổng
    }
}

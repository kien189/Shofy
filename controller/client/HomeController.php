<?php
require_once "../model/Product.php";
require_once "../model/Category.php";
require_once "../includes/CartProvider.php";
class HomeController
{
    protected $productModel;
    protected $categoryModel;

    protected $cartModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->cartModel = new Cart();
    }

    public function index()
    {
        // echo '<pre>';
        // print_r($products);
        // echo '</pre>';
        //Lấy instace của cartProvider
        // $cartProvider = CartProvider::getInstance();
        // $cartProvider->updateCarts();
        // $cartItems = $cartProvider->getCartItems();
        // $carts = $this->cartModel->getAllCarts();
        // echo '<pre>';
        // print_r($carts);
        // echo '</pre>';
        $products = $this->productModel->getAllProduct();
        $categories = $this->categoryModel->getAllCategory();
        shuffle($products);
        shuffle($categories);

        // Truyền biến $carts vào header
        // require_once "../views/client/layout/header.php";

        // Sau đó load trang index
        require_once "../views/client/index.php";
    }


    public function getLimitedProduct(&$products, $limit)
    {
        $limitedProducts = array_slice($products, 0, $limit);
        $products = array_slice($products, $limit);
        return $limitedProducts;
    }


    public function productDetails()
    {
        $productDetail = $this->productModel->getProductDetailBySlug($_GET['slug']);
        $productDetail = reset($productDetail);
        $variants = $productDetail['variants'] ?? [];

        // Lấy tất cả kích thước và loại bỏ trùng lặp
        $sizes = array_column($variants, 'size');
        $uniqueSizes = array_unique($sizes);

        // Lấy tất cả màu sắc và loại bỏ trùng lặp
        $uniqueColors = array_map(function ($variant) {
            return ['color_name' => $variant['color_name'], 'color_code' => $variant['color_code']];
        }, $variants);

        // Loại bỏ trùng lặp dựa trên mã màu
        $uniqueColors = array_unique($uniqueColors, SORT_REGULAR);

        // echo "<pre>";
        // print_r($productDetail);
        // echo "</pre>";

        require_once "../views/client/product/detail.php";
    }


    public function shop()
    {
        $products = $this->productModel->getAllProduct();
        $categories = $this->categoryModel->getAllCategory();
        $countCate = $this->CountCate($categories);
        $searchProduct = $this->search();
       
        // echo '<pre>';
        // print_r($searchProduct);
        // echo '<pre>';
        return $data = [
            'products' => $products,
            'categories' => $categories,
            'countCate' => $countCate,
            'searchProduct' => $searchProduct
        ];
    }

    public function CountCate($categories)
    {
        $countCate = [];
        foreach ($categories as $cate) {
            $countCate[$cate['id']] = $this->categoryModel->getProductCountByCategory($cate['id']);
        }
        return $countCate;
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchProduct'])) {
            $_SESSION['keyword'] = $_POST['keyword'];
            $searchProduct = $this->productModel->searchProduct($_POST['keyword']);
            $keyword =  str_replace(' ', '-', $_POST['keyword']);
            if($searchProduct){
                $_SESSION['success'] = 'Danh sách sản phẩm với keyword' . ' ' . $_POST['keyword'];
            }else{
                $_SESSION['error'] = 'Không tìm thấy sản phẩm với keyword' . ' ' . $_POST['keyword'];
            }
            return $searchProduct;
        }
    }
    public function filterCateById()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['category_id'])) {
            $getProductByCate = $this->categoryModel->getProductByCateId();
            return $getProductByCate ?? null;
        }
    }
}

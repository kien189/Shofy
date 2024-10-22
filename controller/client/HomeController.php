<?php
require_once "../model/Product.php";
require_once "../model/Category.php";
require_once "../model/Comment.php";

class HomeController
{
    protected $productModel;
    protected $categoryModel;

    protected $cartModel;
    protected $comment;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->cartModel = new Cart();
        $this->comment = new Comment();
    }

    public function index()
    {
        $products = $this->productModel->getAllProduct();
        $categories = $this->categoryModel->getAllCategory();
        shuffle($products);
        shuffle($categories);
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
        $comment = $this->comment->getComentById($productDetail['product_id']);
        $custormRatings = $this->custormRating($comment);
        $sizes = array_column($variants, 'size');
        $uniqueSizes = array_unique($sizes);

        // Lấy tất cả màu sắc và loại bỏ trùng lặp
        $uniqueColors = array_map(function ($variant) {
            return ['color_name' => $variant['color_name'], 'color_code' => $variant['color_code']];
        }, $variants);

        // Loại bỏ trùng lặp dựa trên mã màu
        $uniqueColors = array_unique($uniqueColors, SORT_REGULAR);

        // echo "<pre>";
        // print_r($custormRatings);
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
            $keyword = str_replace(' ', '-', $_POST['keyword']);
            if ($searchProduct) {
                $_SESSION['success'] = 'Danh sách sản phẩm với keyword' . ' ' . $_POST['keyword'];
            } else {
                $_SESSION['error'] = 'Không tìm thấy sản phẩm với keyword' . ' ' . $_POST['keyword'];
                header("Location:" . $_SERVER['HTTP_REFERER']);
                exit();
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


    public function custormRating($comment)
    {
        $totalRating = 0;
        $ratingCount = count($comment);
        if ($ratingCount > 0) {
            for ($i = 0; $i < $ratingCount; $i++) {
                $totalRating += $comment[$i]['rating'];
            }
            $totalRating = $totalRating / $ratingCount;

            $ratingDistribution = array_fill(1, 5, 0); // Tạo mảng với 5 sao
            foreach ($comment as $come) {
                $ratingDistribution[$come['rating']]++;
            }

            // Tính tỷ lệ phần trăm cho mỗi sao
            $ratingPercentages = [];
            foreach ($ratingDistribution as $stars => $count) {
                $ratingPercentages[$stars] = $ratingCount > 0 ? ($count / $ratingCount) * 100 : 0;
            }

            return $data = [
                'totalRating' => $totalRating ?? 0,
                'ratingDistribution' => $ratingDistribution,
                'ratingPercentages' => $ratingPercentages
            ];
        } else {
            return 0;
        }
    }
}

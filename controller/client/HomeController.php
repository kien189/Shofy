<?php
require_once "../model/Product.php";
require_once "../model/Category.php";

class HomeController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
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
}
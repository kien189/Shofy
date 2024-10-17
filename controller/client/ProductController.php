<?php
require_once "../model/Product.php";
class ProductController  extends Product
{
    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchProduct'])) {

            $searchProduct = $this->searchProduct($_POST['keyword']);
            $keyword =  str_replace(' ', '-', $_POST['keyword']);
            if (!empty($searchProduct)) {
                $_SESSION['success'] = 'Danh sách sản phẩm với keyword' . ' ' . $_POST['keyword'];
                exit();
            } else {
                $_SESSION['error'] = 'Không tìm thấy sản phẩm với keyword' . ' ' . $_POST['keyword'];
                header("location:" . $_SERVER['HTTP_REFERER']);
            }
            echo '<pre>';
            print_r($searchProduct);
            echo '<pre>';
            return $searchProduct;
        }
    }


    public function filterCate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        }
    }
}

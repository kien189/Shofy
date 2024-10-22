<?php
require_once "../model/Product.php";
require_once "../model/Comment.php";
class ProductController
{
    protected $product;
    protected $comment;

    public function __construct()
    {
        $this->product = new Product();
        $this->comment = new Comment();
    }
    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchProduct'])) {

            $searchProduct = $this->product->searchProduct($_POST['keyword']);
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


    public function review()
    {

        if (isset($_SESSION['user'])) {
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['review'])) {
                if (empty($_POST['product_id']) || empty($_POST['content']) || empty($_POST['rating'])) {
                    $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
                    header("Location:" . $_SERVER['HTTP_REFERER']);
                    exit();
                }
                // echo '<pre>';
                // print_r($_POST);
                // echo '<pre>';
                $comment = $this->comment->sendComment($_POST['product_id'], $_POST['content'], $_POST['rating']);
                if ($comment) {
                    $_SESSION['success'] = 'Review thành công .';
                    header("Location:" . $_SERVER['HTTP_REFERER']);
                    exit();
                } else {
                    $_SESSION['error'] = 'Đã có lỗi xảy ra vui lòng thử lại  .';
                    header("Location:" . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            }
        } else {
            $_SESSION['error'] = 'Bạn cần đăng nhập để bình luận';
            header("Location:" . $_SERVER['HTTP_REFERER']);
        }
    }

    // public function 
}

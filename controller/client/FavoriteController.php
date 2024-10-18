<?php
require_once "../model/Favorite.php";

class FavoriteController extends Favorite
{

    public function index()
    {
        $listFavorite = $this->listFavorite();
        require_once '../views/client/favorite/list.php';
    }

    public function addWishlist()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $checkFavorite = $this->checkFavorite();
            if ($checkFavorite) {
                $_SESSION['success'] = 'Sản phẩm đã tồn tại trong danh sách yêu thích';
                header("Location:" . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $addWishlist = $this->addFavorite($_GET['product_id']);
                if (!empty($addWishlist)) {
                    $_SESSION['success'] = 'Yêu thích sản phẩm thành công';
                    header("Location:" . $_SERVER['HTTP_REFERER']);
                } else {
                    $_SESSION['error'] = 'Có lỗi xảy ra vui lòng thử lại';
                    header("Location:" . $_SERVER['HTTP_REFERER']);
                }
            }
        }
    }

    public function checkFavorite()
    {
        $checkFavorite = $this->favoriteExists($_GET['product_id']);
        return $checkFavorite;
    }


    public function removeFavorite()
    {
        try {
            $removeFavorite = $this->deleteFavorite($_GET['id']);
            $_SESSION['success'] = 'Xóa sản phẩm yêu thích thành công';
            header("Location:" . $_SERVER['HTTP_REFERER']);
            exit();
        } catch (\Throwable $e) {
            $_SESSION['error'] = 'Đã có lỗi xảy ra vui lòng thử lại';
            header("Location:" . $_SERVER['HTTP_REFERER']);
            exit();
        }

    }
}
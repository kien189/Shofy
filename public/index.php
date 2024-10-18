<?php
session_start();
require_once "../controller/admin/AuthAdminController.php";
require_once "../controller/admin/CategoryAdminController.php";
require_once "../controller/admin/ProductAdminController.php";
require_once "../controller/admin/OrderAdminController.php";
require_once "../controller/client/UserController.php";
require_once "../controller/client/HomeController.php";
require_once "../controller/client/CartController.php";
require_once "../controller/client/OrderController.php";
require_once "../controller/client/ProductController.php";
require_once "../controller/client/FavoriteController.php";
require_once "../controller/client/ProfileController.php";
$action = isset($_GET['act']) ? $_GET['act'] : 'index';
$userController = new UserController();
$authController = new AuthAdminController();
$category = new CategoryAdminController();
$product = new ProductAdminController();
$home = new HomeController();
$cart = new CartController();
$order = new OrderController();
$orderAdmin = new OrderAdminController();
$productClinet = new ProductController();
$favorite = new FavoriteController();
$profile = new ProfileController();
// $adminRoutes = ['dashboard', 'logout_admin'];
// if (in_array($action, $adminRoutes) && !$authController->isAdmin()) {
//     header("Location: index.php?act=admin"); // Chuyển hướng đến trang đăng nhập admin nếu chưa đăng nhập
//     exit();
// }
//check quyền admin
switch ($action) {
    case 'index':
        $home->index();
        break;
    case 'login':
        $userController->login();
        include "../views/client/login/login.php";
        break;
    case 'register':
        $userController->register();
        include "../views/client/login/register.php";
        break;
    case 'logout':
        $userController->logout();
        break;
    case 'forgot_password':
        include "../views/client/forgot_password.php";
        break;
    case 'reset_password':
        include "../views/client/reset_password.php";
        break;
    case 'profile':
        $profile->index();
        break;
    case 'updateProfile';
        $profile->updateProfile();
        break;
    case "product_detail":
        $home->productDetails();
        break;
    case 'addToCart':
        $cart->AddToCarts();
        break;
    case 'cart':
        $cart->getCarts();
        break;
    case 'updateCarts':
        $cart->updateCarts();
        break;
    case 'removeCart':
        $cart->deleleCarts();
        break;
    case 'buyNow':
        $detailCheckout = $cart->getDetailProduct();
        $getCheckout = $cart->getCart();

        include "../views/client/buyNow/buyNow.php";
        break;
    case 'checkout':
        $order->checkout();
        break;
    case 'order':
        $order->Orders();
        break;
    case 'shop':
        $data = $home->shop();
        $getProductByCate = $home->filterCateById();
        include "../views/client/shop/shop.php";
        break;
    case 'vnpayReturn':
        $order->vnpayReturn();
        break;
    case 'favorite':
        $favorite->index();
        break;
    case 'addFavorite':
        $favorite->addWishlist();
        break;
    case 'removeFavorite':
        $favorite->removeFavorite();
        break;
    // case "search/{id}":
    //     $searchProduct = $productClinet->search();
    //     include "../views/client/shop/shop.php";
    //     break;
    // case 'momoReturn':
    //     $order->momoReturn();
    //     break;


    //    admin    =============================================================================================
    case 'admin':
        $authController->login();
        include "../views/admin/auth/login.php";
        break;
    case 'dashboard':
        $authController->middleware();
        include "../views/admin/index.php";
        break;
    case 'register_admin':
        $authController->register();
        include "../views/admin/auth/register.php";
        break;
    case 'logout_admin':
        $authController->logout();
        break;
    case "category":
        $authController->middleware();
        $listCategory = $category->getCategory();
        include "../views/admin/category/list.php";
        break;
    case "add_category":
        $authController->middleware();
        $category->createCategory();
        include "../views/admin/category/add.php";
        break;
    case "edit_category":
        $authController->middleware();
        $getCategory = $category->editCategory($_GET['id']);
        include "../views/admin/category/edit.php";
        break;
    case "update_category":
        $authController->middleware();
        $category->updateCate();
        break;
    case "delete_category":
        $authController->middleware();
        $category->deleteCate();
        break;
    case "product":
        $authController->middleware();
        $listProduct = $product->getProductAll();
        include "../views/admin/product/list.php";
        break;
    case "add_product":
        $authController->middleware();
        $size = $product->getAllSize();
        $color = $product->getAllColor();
        $listCategory = $category->getCategory();
        $product->addProducts();
        include "../views/admin/product/add.php";
        break;
    case "edit_product":
        $authController->middleware();
        $size = $product->getAllSize();
        $color = $product->getAllColor();
        $listCategory = $category->getCategory();
        $getProductID = $product->getProductById($_GET['product_id']);
        include "../views/admin/product/edit.php";
        break;
    case "update_product":
        $authController->middleware();
        $product->updateProducts();
        break;
    case "delete_variant":
        $product->deleteVariantsId();
        break;

    case "delete_product":
        $authController->middleware();
        $product->deleteProductAll();
        break;
    case "deleteGallery":
        $product->deleteGallery();
        break;
    case "orders":
        $orderAdmin->index();
        break;

    case "order_detail":
        $orderAdmin->detail();
        break;
    case "update_order":
        $orderAdmin->updateOrders();
        break;
    case "order_delete":
        $orderAdmin->removeOrder();
        break;
}

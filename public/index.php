<?php
session_start();
require_once "../controller/client/UserController.php";
require_once "../controller/admin/AuthController.php";
require_once "../controller/admin/CategoryController.php";
require_once "../controller/admin/ProductController.php";
$action = isset($_GET['act']) ? $_GET['act'] : 'index';
$userController = new UserController();
$authController = new AuthController();
$category = new CategoryController();
$product = new ProductController();
// $adminRoutes = ['dashboard', 'logout_admin'];
// if (in_array($action, $adminRoutes) && !$authController->isAdmin()) {
//     header("Location: index.php?act=admin"); // Chuyển hướng đến trang đăng nhập admin nếu chưa đăng nhập
//     exit();
// }
//check quyền admin
switch ($action) {
    case 'index':
        include "../views/client/index.php";
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
    case "product":
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
        include "../views/admin/product/edit.php";
        break;
}

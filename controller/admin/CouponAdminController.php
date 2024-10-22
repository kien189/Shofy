<?php
require_once '../model/Coupon.php';
class CouponAdminController extends Coupon
{
    public function index()
    {
        $coupons  = $this->getAllCoupons();
        // echo '<pre>';
        // print_r($coupons);
        // echo '<pre>';
        require_once '../views/admin/coupon/list.php';
    }



    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCoupon'])) {
            $coupon = $this->addCoupon($_POST['name'], $_POST['start_date'], $_POST['end_date'], $_POST['status'], $_POST['type'], $_POST['coupon_value'], $_POST['quantity'], $_POST['coupon_code']);
            if ($coupon) {
                $_SESSION['success'] = 'Thêm mới mã giảm giá thành công .';
                header("location:index.php?act=coupons");
                exit();
            } else {
                $_SESSION['error'] = 'Đã có lỗi xảy ra vui lòng thử lại .';
                header("location:" . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function getCoupon()
    {
        $coupon = $this->editCoupon($_GET['id']);
        require_once '../views/admin/coupon/edit.php';
    }
    public function getDetailCoupon()
    {
        $coupon = $this->editCoupon($_GET['id']);
        require_once '../views/admin/coupon/detail.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateCoupon'])) {
            $updateCoupon = $this->updateCoupon($_POST['name'], $_POST['start_date'], $_POST['end_date'], $_POST['status'], $_POST['type'], $_POST['coupon_value'], $_POST['quantity'], $_POST['coupon_code'], $_POST['id']);
            if ($updateCoupon) {
                $_SESSION['success'] = 'Cập nhật mã giảm giá thành công .';
                header("Location: index.php?act=coupons");
                exit();
            } else {
                $_SESSION['error'] = 'Đã có lỗi xảy ra vui lòng thử lại .';
                header("Location:" . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function delete()
    {
        try {
            $delete = $this->deleteCoupon($_GET['id']);
            $_SESSION['success'] = 'Xóa mã giảm giá thành công.';
            header('Location:index.php?act=coupons');
            exit();
        } catch (\Throwable $th) {
            //throw $th;
            $_SESSION['error'] ='Đã có lỗi xảy ra vui lòng thử lại.';
            header('Location:'.$_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}

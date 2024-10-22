<?php
require_once "../includes/conectDB.php";
class Coupon
{
    protected $db;
    public function __construct()
    {
        $this->db = conectDB();
    }

    public function getAllCoupons()
    {
        $sql = "select  * from coupon";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCoupon($name, $start_date, $end_date, $status, $type, $coupon_value, $quantity, $coupon_code)
    {
        $sql = "insert into coupon(name,start_date,end_date,status,type,coupon_value,quantity,coupon_code,created_at,	updated_at) values(?,?,?,?,?,?,?,?,now(),now())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $start_date, $end_date, $status, $type, $coupon_value, $quantity, $coupon_code]);
    }

    public function editCoupon($id)
    {
        $sql = 'select * from coupon where id =?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCoupon($name, $start_date, $end_date, $status, $type, $coupon_value, $quantity, $coupon_code, $id)
    {
        $sql = 'update coupon set name = ?,start_date  = ?,end_date = ?,status = ?,type = ?,coupon_value=?,quantity = ?,coupon_code=?,created_at = now(),	updated_at = now() where id =?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $start_date, $end_date, $status, $type, $coupon_value, $quantity, $coupon_code, $id]);
    }

    public function deleteCoupon($id)
    {
        $sql = 'delete from coupon where id=?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }


    public function getCouponByCode($coupon_code)
    {
        $sql = 'select * from coupon where coupon_code = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$coupon_code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

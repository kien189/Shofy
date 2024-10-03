<?php
require_once "../includes/conectDB.php";


class Order
{

    protected $db;
    public function __construct()
    {
        $this->db =  conectDB();
    }


    public function addOrder($user_id, $product_id, $variant_id, $quantity, $order_id)
    {
        $sql = "INSERT INTO `oder` (user_id, product_id, variant_id, quantity, order_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$user_id, $product_id, $variant_id, $quantity, $order_id]);
        return $stmt;
    }
    


    public function addOrderDetail($name, $email, $phone, $address, $user_id, $amout, $note)
    {
        $sql = "INSERT INTO order_detail (name,email,phone,address,user_id,amout,note,status) VALUES (?, ?,?,?,?,?,?,'pending')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $email, $phone, $address, $user_id, $amout, $note]);
        return $stmt;
    }


    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }


    public function deleteCart()
    {

        $sql = "DELETE FROM cart WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_POST['cart_id']]);
        return $stmt;
    }
}

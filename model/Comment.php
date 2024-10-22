<?php
require_once "../includes/conectDB.php";

class Comment
{
    protected $db;

    public function __construct()
    {
        $this->db = conectDB();
    }

    public function sendComment($product_id, $content, $rating)
    {
        $sql = "insert into comment(user_id,product_id,content,rating,created_at,updated_at) values(?,?,?,?,now(),now())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$_SESSION['user']['id'], $product_id, $content, $rating]);
    }

    public function  getComentById($product_id)
    {
        $sql = "select * from comment where user_id = ? and product_id =?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_SESSION['user']['id'], $product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

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
        // Kiểm tra xem người dùng đã mua sản phẩm này chưa
        $userId = $_SESSION['user']['id'];
        $checkPurchaseSql = "SELECT COUNT(*) as purchase_count
                             FROM oder o
                             JOIN order_detail od ON od.id = o.order_id
                             WHERE o.user_id = ? AND o.product_id = ?";

        $checkStmt = $this->db->prepare($checkPurchaseSql);
        $checkStmt->execute([$userId, $product_id]);
        $purchaseResult = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($purchaseResult['purchase_count'] > 0) {
            // Nếu người dùng đã mua sản phẩm, cho phép gửi bình luận
            $sql = "INSERT INTO comment(user_id, product_id, content, rating, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, NOW(), NOW())";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$userId, $product_id, $content, $rating]);
        } else {
            // Nếu chưa mua sản phẩm, trả về false hoặc thông báo lỗi
            return false;
        }
    }


    public function  getComentById($product_id)
    {
        $sql = "select 
            u.name as user_name,
            u.avatar as user_avatar,
            cm.content as content,
            cm.rating as rating, 
            cm.created_at as created_at
            from comment cm
            join users  u ON u.id = cm.user_id
        where  product_id =?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([ $product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

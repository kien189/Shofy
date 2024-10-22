<?php
require_once "../includes/conectDB.php";
class Cart
{
    protected $db;
    public function __construct()
    {
        $this->db =  conectDB();
    }


    public function addToCart($userId, $productId, $variantId, $quantity)
    {
        $sql = "INSERT INTO cart(user_id,product_id,variant_id,quantity) VALUES(?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId, $productId, $variantId, $quantity]);
    }

    public function byNow($userId, $productId, $variantId, $quantity)
    {
        $sql = "INSERT INTO cart(user_id,product_id,variant_id,quantity,status) VALUES(?,?,?,?,'pending_payment')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $productId, $variantId, $quantity]);
        // Lấy ID của bản ghi vừa thêm
        $cartId = $this->db->lastInsertId();

        // Truy xuất bản ghi vừa được thêm
        $sql = "SELECT * FROM cart WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cartId]);

        return $stmt->fetch();
    }


    public function checkCart()
    {
        $sql = "SELECT * FROM cart  WHERE user_id = ? AND product_id = ? AND variant_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_SESSION['user']['id'], $_POST['product_id'], $_POST['variant_id']]);
        return $stmt->fetch();
    }

    public function updateCart($userId, $productId, $variantId, $quantity)
    {
        $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ? AND variant_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$quantity, $userId, $productId, $variantId]);
    }

    public function getDetailProduct()
    {
        $sql = "
                    SELECT 
            p.id AS product_id,
            p.name AS product_name,
            pv.id AS variant_id,
            pv.price AS variant_price,
            pv.sale_price AS variant_sale_price,
            vc.color_name AS variant_color,
            vs.size AS variant_size
            FROM product p
            LEFT JOIN product_variant pv ON p.id = pv.product_id
            LEFT JOIN variant_color vc ON pv.variant_color_id = vc.id
            LEFT JOIN variant_size vs ON pv.variant_size_id = vs.id
            WHERE p.id = ?  
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_GET['product_id']]);

        return $stmt->fetch();
    }


    public function getCart()
    {
        $sql = "SELECT * FROM cart WHERE id = ? ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_GET['id']]);
        return $stmt->fetchAll();
    }


    public function getAllCarts()
    {
        $sql = "SELECT
        p.id as product_id,
         p.name as product_name,
         p.slug as product_slug,
         p.image as product_image,
         pv.sale_price as variant_price,
         pv.id as variant_id,
         vc.color_name as variant_color,
         vs.size as variant_size,
         c.quantity as cart_quantity,
         c.id as cart_id
        FROM cart c
        JOIN product p ON c.product_id = p.id
        JOIN product_variant pv ON c.variant_id = pv.id
        JOIN variant_color vc ON pv.variant_color_id = vc.id
        JOIN variant_size vs ON pv.variant_size_id = vs.id
        WHERE c.user_id = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_SESSION['user']['id'] ?? null]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function updateCartById($cartId, $quantity)
    {
        $sql = "UPDATE cart SET quantity = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$quantity, $cartId]);
    }



    public function deleteCart($cartId)
    {
        $sql = "DELETE FROM cart WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$cartId]);
    }


    public function getCouponByCode($coupon_code)
    {
        $sql = 'select * from coupon where coupon_code = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$coupon_code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

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
        $sql = "INSERT INTO `oder` (user_id, product_id, variant_id, quantity, order_id,created_at,updated_at) VALUES (?, ?, ?, ?, ?,now(),now())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$user_id, $product_id, $variant_id, $quantity, $order_id]);
        return $stmt;
    }



    public function addOrderDetail($name, $email, $phone, $address, $user_id, $amount, $note)
    {
        $sql = "INSERT INTO order_detail (name,email,phone,address,user_id,amount,note,status,created_at,updated_at) VALUES (?, ?,?,?,?,?,?,'pending',now(),now())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $email, $phone, $address, $user_id, $amount, $note]);
        return $stmt;
    }


    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }


    public function deleteCart($cart_id)
    {

        $sql = "DELETE FROM cart WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cart_id]);
        return $stmt;
    }

    public function getAllOrder()
    {
        $sql = "SELECT
    od.id AS order_detail_id,
    od.user_id AS user_id,
    od.name AS name,
    od.email AS email,
    od.phone AS phone,
    od.address AS address,
    od.amount AS amount,
    od.note AS note,
    od.status AS status,
    od.created_at AS created_at,
    od.updated_at AS updated_at,
    MAX(o.id) AS order_id, -- Sử dụng MAX hoặc MIN
    GROUP_CONCAT(p.name) AS order_product_name,
    GROUP_CONCAT(p.image) AS order_product_image,
    SUM(pv.price) AS order_product_price,
    SUM(o.quantity) AS quantity,
    MAX(c.name) AS category_name -- Sử dụng MAX hoặc MIN
    FROM order_detail od
    LEFT JOIN `oder` o ON od.id = o.order_id
    LEFT JOIN product p ON o.product_id = p.id
    LEFT JOIN category c ON p.category_id = c.id
    LEFT JOIN product_variant pv ON o.variant_id = pv.id
    GROUP BY od.id;
";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById()
    {
        $sql = "SELECT
            od.id as order_detail_id,
            od.user_id as user_id,
            od.name as name,
            od.email as email,
            od.phone as phone,
            od.address as address,
            od.amount as amount,
            od.note as note,
            od.status as status,
            od.created_at as created_at,
            od.updated_at as updated_at,
            o.id as order_id,
            p.name as order_product_name,
            p.image as order_product_image,
            pv.price as order_product_price,
            o.quantity as quantity,
            c.name as category_name
            FROM order_detail od
            LEFT JOIN `oder` o ON od.id = o.order_id
            LEFT JOIN product p ON o.product_id = p.id
            LEFT JOIN category c ON p.category_id = c.id
            LEFT JOIN product_variant pv ON o.variant_id = pv.id
            WHERE od.id = ?
            ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_GET['id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // public function getOrderProduct()
    // {
    //     $sql = "SELECT
    //     o.id as order_id,
    //     p.name as order_product_name,
    //     p.image as order_product_image,
    //     pv.price as order_product_price,
    //     vs.size as order_variant_size_name,
    //     vc.color_name as order_variant_color_name,
    //     o.quantity as quantity
    //     FROM `oder` o
    //     LEFT JOIN product p ON o.product_id = p.id
    //     LEFT JOIN product_variant pv ON pv.product_id = p.id
    //     LEFT JOIN variant_color vc ON pv.variant_color_id = vc.id
    //     LEFT JOIN variant_size vs ON pv.variant_size_id = vs.id
    //     WHERE o.order_id = ?
    //     ";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->execute([$_GET['id']]); // Giả sử $_GET['id'] là order_id
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC); // Sử dụng fetchAll để lấy nhiều dòng
    // }

    public function getOrderProduct()
{
    $sql = "SELECT
        o.id as order_id,
        p.name as order_product_name,
        p.image as order_product_image,
        SUM(pv.price) as order_product_price,  -- Tổng giá cho sản phẩm
        GROUP_CONCAT(DISTINCT vs.size) as order_variant_size_name,  -- Kết hợp kích thước
        GROUP_CONCAT(DISTINCT vc.color_name) as order_variant_color_name,  -- Kết hợp màu sắc
        SUM(o.quantity) as quantity  -- Tổng số lượng sản phẩm
    FROM `oder` o
    LEFT JOIN product p ON o.product_id = p.id
    LEFT JOIN product_variant pv ON pv.product_id = p.id
    LEFT JOIN variant_color vc ON pv.variant_color_id = vc.id
    LEFT JOIN variant_size vs ON pv.variant_size_id = vs.id
    WHERE o.order_id = ?
    GROUP BY o.id, p.name, p.image;  -- Nhóm theo order_id và các cột không tổng hợp khác
    ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$_GET['id']]); // Giả sử $_GET['id'] là order_id
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Sử dụng fetchAll để lấy nhiều dòng
}


    public function updateOrder($id, $status)
    {
        $sql = "UPDATE `order_detail` SET status = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$status, $id]); // Sử dụng id từ tham số
        return $stmt; // Trả về true nếu có bản ghi bị cập nhật
    }


    public function deleteOrder()
    {
        $sql = "DELETE FROM `order_detail` WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_GET['id']]);
        return $stmt;
    }
}

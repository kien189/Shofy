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
    SUM(o.quantity) AS quantity
    FROM order_detail od
    LEFT JOIN `oder` o ON od.id = o.order_id
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

    public function getOrderProduct()
    {
        $sql = "SELECT
            o.id as order_id,
            p.name as order_product_name,
            p.image as order_product_image,
            pv.sale_price as order_product_price,
            vs.size as order_variant_size_name,
            vc.color_name as order_variant_color_name,
            o.quantity as quantity
        FROM `oder` o
        LEFT JOIN product p ON o.product_id = p.id
        LEFT JOIN product_variant pv ON o.variant_id = pv.id
        LEFT JOIN variant_color vc ON pv.variant_color_id = vc.id
        LEFT JOIN variant_size vs ON pv.variant_size_id = vs.id
        WHERE o.order_id = ?";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_GET['id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


   


    // public function updateOrder($id, $status)
    // {
    //     $sql = "UPDATE `order_detail` SET status = ? WHERE id = ?";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->execute([$status, $id]); // Sử dụng id từ tham số
    //     return $stmt; // Trả về true nếu có bản ghi bị cập nhật
    // }
    public function updateOrder($id, $status)
    {
        // Lấy trạng thái hiện tại của đơn hàng
        $sql = "SELECT status FROM `order_detail` WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $currentStatus = $stmt->fetchColumn();

        // Các trạng thái hợp lệ mà đơn hàng có thể chuyển tiếp
        $allowedStatusUpdates = [
            'Pending' => ['Confirmed', 'Shipped',],
            'Confirmed' => ['Shipped', 'Canceled'],
            'Shipped' => ['Delivered'],
            'Delivered' => [] // 'delivered' không thể cập nhật
        ];

        // Sử dụng hàm PHP để kiểm tra trạng thái mới có hợp lệ không
        // Kiểm tra xem trạng thái hiện tại có tồn tại trong mảng $allowedStatusUpdates không.
        // Nếu không tồn tại, nghĩa là trạng thái hiện tại không thể cập nhật lên bất kỳ trạng thái nào khác.
        if (
            !isset($allowedStatusUpdates[$currentStatus])
            // Kiểm tra xem trạng thái mới ($status) có nằm trong danh sách trạng thái hợp lệ tiếp theo của trạng thái hiện tại không.
            || !in_array($status, $allowedStatusUpdates[$currentStatus])
        ) {
            // Nếu trạng thái hiện tại không tồn tại trong mảng hoặc trạng thái mới không hợp lệ, trả về false.
            return false; // Trạng thái không hợp lệ
        }


        // Thực hiện cập nhật trạng thái nếu hợp lệ
        $sql = "UPDATE `order_detail` SET status = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$status, $id]); // Trả về true nếu cập nhật thành công
    }



    public function deleteOrder()
    {
        $sql = "DELETE FROM `order_detail` WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_GET['id']]);
        return $stmt;
    }

    public function getOrderByUser()
    {
        $sql = 'select * from order_detail where user_id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_SESSION['user']['id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

<?php
require_once "../includes/conectDB.php";

class Product
{
    protected $db;
    public function __construct()
    {
        $this->db =  conectDB();
    }

    public function getColorAll()
    {
        $sql = "SELECT * FROM variant_color";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getSizeAll()
    {
        $sql = "SELECT * FROM variant_size";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addProduct($name, $image, $priceProduct, $category_id, $description)
    {
        $sql = "INSERT INTO product(name,image,price,category_id,description) VALUES(?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $image, $priceProduct, $category_id, $description]);
    }

    public function addProductVariant($product_id, $color_id, $size_id, $quantity, $price, $sale_price)
    {
        $sql = "INSERT INTO product_variant(product_id,variant_color_id ,variant_size_id ,quantity,price,sale_price) VALUES(?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$product_id, $color_id, $size_id, $quantity, $price, $sale_price]);
    }

    public function addProductImage($product_id, $image)
    {
        $sql = "INSERT INTO product_gallery(product_id,image) VALUES(?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$product_id, $image]);
    }

    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }


    public function getAllProduct()
    {
        // Câu truy vấn SQL để lấy thông tin từ product, category và product_variant
        $sql = "
            SELECT 
                p.id as product_id, 
                p.name as product_name, 
                p.image as product_image, 
                p.price as product_price, 
                p.description as product_description, 
                c.id as category_id, 
                c.name as category_name, 
                pv.id as product_variant_id, 
                pv.price as variant_price, 
                pv.sale_price as variant_sale_price, 
                pv.quantity as variant_quantity, 
                vc.color_name as variant_color_name, 
                vs.size as variant_size_name
            FROM 
                product p
            LEFT JOIN 
                category c ON p.category_id = c.id
            LEFT JOIN 
                product_variant pv ON p.id = pv.product_id
            LEFT JOIN 
                variant_color vc ON pv.variant_color_id = vc.id
            LEFT JOIN 
                variant_size vs ON pv.variant_size_id = vs.id
        ";

        $stmt = $this->db->query($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        // var_dump($results[0]['product_id']);
        // Tạo một mảng để nhóm các sản phẩm với các biến thể
        $groupedProducts = [];

        foreach ($results as $row) {
            $productId = $row['product_id'];

            // Nếu sản phẩm chưa tồn tại trong mảng $groupedProducts, tạo mới
            if (!isset($groupedProducts[$productId])) {
                $groupedProducts[$productId] = [
                    'product_id' => $row['product_id'],
                    'product_name' => $row['product_name'],
                    'product_image' => $row['product_image'],
                    'product_price' => $row['product_price'],
                    'product_description' => $row['product_description'],
                    'category_name' => $row['category_name'],
                    'variants' => [] // Biến thể (kích thước, màu sắc)
                ];
            }

            // Thêm các biến thể vào mảng 'variants'
            $groupedProducts[$productId]['variants'][] = [
                'variant_size' => $row['variant_size_name'],
                'variant_color' => $row['variant_color_name'],
                'variant_price' => $row['variant_price']
            ];
        }
        return  $groupedProducts;
    }
    public function getProductInfo($product_id)
    {
        $sql = "
            SELECT 
                p.id as product_id, 
                p.name as product_name, 
                p.image as product_image, 
                p.price as product_price, 
                p.description as product_description, 
                c.id as category_id, 
                c.name as category_name
            FROM 
                product p
            LEFT JOIN 
                category c ON p.category_id = c.id
            WHERE p.id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getProductGallery($product_id)
    {
        $sql = "
        SELECT image 
        FROM product_gallery
        WHERE product_id = ?
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng các ảnh
    }
    public function getProductVariants($product_id)
    {
        $sql = "
        SELECT 
            pv.id as product_variant_id, 
            pv.price as variant_price, 
            pv.sale_price as variant_sale_price, 
            pv.quantity as variant_quantity, 
            vc.color_name as variant_color_name, 
            vc.id as variant_color_id,
            vs.id as variant_size_id,
            vs.size as variant_size_name
        FROM 
            product_variant pv
        LEFT JOIN 
            variant_color vc ON pv.variant_color_id = vc.id
        LEFT JOIN 
            variant_size vs ON pv.variant_size_id = vs.id
        WHERE pv.product_id = ?
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách biến thể
    }


    public function deleteVariantsById($product_variant_id)
    {

        $sql = "DELETE FROM product_variant WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$product_variant_id]);
    }


    public function updateProduct($product_id, $name, $image, $priceProduct, $category_id, $description)
    {
        $sql = "UPDATE product SET name = ?, image = ?, price = ?, category_id = ?, description = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $image, $priceProduct, $category_id, $description, $product_id]);
    }

    public function updateProductVariant($product_variant_id, $product_id, $color_id, $size_id, $quantity, $price, $sale_price)
    {
        $sql = "UPDATE product_variant SET product_id = ?, variant_color_id = ?, variant_size_id = ?, quantity = ?, price = ?, sale_price = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$product_id, $color_id, $size_id, $quantity, $price, $sale_price, $product_variant_id]);
    }


    public function deleteProduct($product_id){
        $sql = "DELETE FROM product WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$product_id]);
    }

    public function deleteProductVariant($product_variant_id){
        $sql="DELETE FROM product_variant WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$product_variant_id]);
    }

    public function deleteProductGallery($product_id){
        $sql="DELETE FROM product_gallery WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$product_id]);
    }





























    // public function getAllProduct()
    // {
    //     // Câu truy vấn SQL để lấy thông tin từ bảng product, category, product_variant, variant_color, và variant_size
    //     $sql = "
    //     SELECT 
    //         p.id as product_id,                 // Lấy id của sản phẩm từ bảng product, và đặt tên là product_id
    //         p.name as product_name,             // Lấy tên sản phẩm từ bảng product, và đặt tên là product_name
    //         p.image as product_image,           // Lấy hình ảnh sản phẩm từ bảng product, và đặt tên là product_image
    //         p.price as product_price,           // Lấy giá sản phẩm từ bảng product, và đặt tên là product_price
    //         p.description as product_description, // Lấy mô tả sản phẩm từ bảng product, và đặt tên là product_description
    //         c.id as category_id,                // Lấy id của danh mục sản phẩm từ bảng category, và đặt tên là category_id
    //         c.name as category_name,            // Lấy tên danh mục từ bảng category, và đặt tên là category_name
    //         pv.id as product_variant_id,        // Lấy id phiên bản sản phẩm từ bảng product_variant, đặt tên là product_variant_id
    //         pv.price as variant_price,          // Lấy giá của phiên bản sản phẩm từ bảng product_variant, đặt tên là variant_price
    //         pv.sale_price as variant_sale_price, // Lấy giá giảm của phiên bản sản phẩm từ bảng product_variant, đặt tên là variant_sale_price
    //         pv.quantity as variant_quantity,    // Lấy số lượng của phiên bản sản phẩm từ bảng product_variant, đặt tên là variant_quantity
    //         vc.color_name as variant_color_name, // Lấy tên màu sắc của phiên bản từ bảng variant_color, đặt tên là variant_color_name
    //         vs.size_name as variant_size_name   // Lấy tên kích thước của phiên bản từ bảng variant_size, đặt tên là variant_size_name
    //     FROM 
    //         product p                           // Bảng sản phẩm (product) với bí danh là p
    //     LEFT JOIN 
    //         category c ON p.category_id = c.id  // Liên kết bảng category với bảng product thông qua category_id
    //     LEFT JOIN 
    //         product_variant pv ON p.id = pv.product_id // Liên kết bảng product_variant với bảng product qua product_id
    //     LEFT JOIN 
    //         variant_color vc ON pv.variant_color_id = vc.id // Liên kết bảng variant_color qua variant_color_id
    //     LEFT JOIN 
    //         variant_size vs ON pv.variant_size_id = vs.id  // Liên kết bảng variant_size qua variant_size_id
    // ";

    //     // Thực hiện truy vấn SQL bằng cách sử dụng phương thức query() của PDO
    //     $stmt = $this->db->query($sql);

    //     // Thực thi câu truy vấn (execute) để lấy dữ liệu từ cơ sở dữ liệu
    //     $stmt->execute();

    //     // Lấy tất cả các kết quả từ câu truy vấn và trả về dưới dạng mảng
    //     return $stmt->fetchAll();
    // }
}

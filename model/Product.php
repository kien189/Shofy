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
}

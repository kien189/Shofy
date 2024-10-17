<?php

class Category
{
    protected $db;

    public function __construct()
    {
        $this->db =  conectDB();
    }

    public function getAllCategory()
    {
        $sql = "SELECT * FROM category";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProductCountByCategory($categoryId)
    {
        $sql= "SELECT COUNT(*) FROM `product` WHERE category_id= ?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchColumn();
    }

    public function getProductByCateId()
    {
        $sql = "select 
            c.id as id ,
            c.name as category_name,
            p.name as product_name ,
            p.slug as product_slug,
            p.price as product_price,
            p.salePrice as product_salePrice,
            p.image as product_image
        from 
         category c
        left join  product p on  c.id = p.category_id 
        where c.id = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_GET['category_id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($name, $description, $images)
    {

        $sql = "INSERT INTO category(name,description,image) VALUES(?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $description, $images]);
    }

    public function getCategoryById($id)
    {

        $sql = "SELECT * FROM category WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }


    public function updateCategory($id, $name, $description, $images)
    {

        $sql = "UPDATE category SET name = ?, description = ?, image = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $description, $images, $id]);
    }

    public function deleteCategory($id)
    {
        $sql = "DELETE FROM category WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
    }
}

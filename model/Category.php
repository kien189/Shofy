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

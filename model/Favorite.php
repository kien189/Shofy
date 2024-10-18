<?php
require_once "../includes/conectDB.php";
class Favorite
{
    protected $db;

    public function __construct()
    {
        $this->db = conectDB();
    }

    public function listFavorite()
    {
        $sql = "select 
            f.id as favorite_id,
            f.quantity as favorite_quantity,
            p.name as product_name,
            p.slug as product_slug,
            p.price as product_price,
            p.salePrice as product_salePrice,
            p.image as product_image
        from favorite f
        left join product p on  f.product_id = p.id
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFavorite($productId){
        $sql ="insert into favorite(user_id,product_id,quantity) values (?,?,1)";
        $stmt=$this->db->prepare($sql);
        return $stmt->execute([$_SESSION['user']['id'],$productId]);
    }

    public function deleteFavorite($id){
        $sql ="delete from favorite where id=?";
        $stmt=$this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function favoriteExists ($productId){
        $sql ='select * from `favorite` where user_id=? and product_id=?';
        $stmt= $this->db->prepare($sql);
        $stmt->execute([$_SESSION['user']['id'],$productId]);
        return $stmt->fetch();
    }
}
<?php
require_once('config/database.php');
require_once('models/Category.php');
class CategoryService{

    public function getAll($sql){
        $database = new Database;
        $conn = $database->getConn();   //khởi tạo đối tượng PDO
        $stmt = $conn->query($sql);

        $categories = [];
        while($row = $stmt->fetch()){
            $category = new Category($row['ma_tloai'],$row['ten_tloai']);
            array_push($categories,$category);
        }
        $conn=null; //đóng kết nối
        return $categories;
    }

    public function getById(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();   //khởi tạo đối tượng PDO
        $stmt = $pdo->prepare('SELECT * FROM theloai WHERE ma_tloai=:matheloai');
        $stmt->execute($arguments);
        $row = $stmt->fetch();
        $category = new Category($row['ma_tloai'],$row['ten_tloai']);
        $pdo=null; //đóng kết nối
        return $category;
    }

    public function insert(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("INSERT INTO `theloai`(`ma_tloai`, `ten_tloai`) VALUES (null,:tentheloai)");
        $stmt->execute($arguments);
        $pdo=null;
    }

    public function update(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("UPDATE `theloai` SET `ten_tloai`=:tentheloai WHERE ma_tloai=:matheloai");
        $stmt->execute($arguments);
        $pdo=null;
    }

    public function delete(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("DELETE from `theloai`WHERE ma_tloai=:matheloai");
        $stmt->execute($arguments);
        $pdo=null;
    }
}
?>
<?php
require_once('config/database.php');
require_once('models/Author.php');
class AuthorService{

    public function getAll($sql){
        $database = new Database;
        $conn = $database->getConn();   //khởi tạo đối tượng PDO
        $stmt = $conn->query($sql);

        $authors = [];
        while($row = $stmt->fetch()){
            $author = new Author($row['ma_tgia'],$row['ten_tgia'],$row['hinh_tgia']);
            array_push($authors,$author);
        }
        $conn=null; //đóng kết nối
        return $authors;
    }

    public function getById(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();   //khởi tạo đối tượng PDO
        $stmt = $pdo->prepare('SELECT * FROM tacgia WHERE ma_tgia=:matacgia');
        $stmt->execute($arguments);
        $row = $stmt->fetch();
        $author = new Author($row['ma_tgia'],$row['ten_tgia'],$row['hinh_tgia']);
        $pdo=null; 
        return $author;
    }

    public function insert(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("INSERT INTO `tacgia`(`ten_tgia`,`hinh_tgia`) VALUES (:tentacgia,:hinhtacgia)");
        $stmt->execute($arguments);
        $pdo=null;
    }

    public function update(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("UPDATE `tacgia` SET `ten_tgia`=:tentacgia, `hinh_tgia`=:hinhtacgia WHERE ma_tgia=:matacgia");
        $stmt->execute($arguments);
        $pdo=null;
    }

    public function delete(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("DELETE from `tacgia`WHERE ma_tgia=:matacgia");
        $stmt->execute($arguments);
        $pdo=null;
    }
}
?>
<?php
require_once('config/database.php');
require_once('models/Article.php');
class ArticleService{

    public function getAll($sql){
        $database = new Database;
        $conn = $database->getConn();   //khởi tạo đối tượng PDO
        $stmt = $conn->query($sql);

        $articles = [];
        while($row = $stmt->fetch()){
            $article = new Article($row['ma_bviet'],$row['tieude'],$row['ten_bhat'],$row['ma_tloai'],$row['tomtat'],$row['noidung'],$row['ma_tgia'],$row['ngayviet'],$row['hinhanh']);
            array_push($articles,$article);
        }
        $conn=null; //đóng kết nối
        return $articles;
    }

    public function getById(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();   //khởi tạo đối tượng PDO
        $stmt = $pdo->prepare('SELECT * FROM baiviet WHERE ma_bviet=:mabaiviet');
        $stmt->execute($arguments);
        $row = $stmt->fetch();
        $article = new Article($row['ma_bviet'],$row['tieude'],$row['ten_bhat'],$row['ma_tloai'],$row['tomtat'],$row['noidung'],$row['ma_tgia'],$row['ngayviet'],$row['hinhanh']);
        $pdo=null; 
        return $article;
    }

    public function insert(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("INSERT INTO `baiviet`(`tieude`,`ten_bhat`,`ma_tloai`,`tomtat`,`noidung`,`ma_tgia`, `hinhanh`) VALUES (:tieude,:tenbaihat,:matheloai,:tomtat,:noidung,:matacgia,:hinhanh)");
        $stmt->execute($arguments);
        $pdo=null;
    }

    public function update(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("UPDATE `baiviet` SET `tieude`=:tieude, `ten_bhat`=:tenbaihat, `ma_tloai`=:matheloai, `tomtat`=:tomtat, `noidung`=:noidung, `ma_tgia`=:matacgia, `hinhanh`=:hinhanh WHERE ma_bviet=:mabaiviet");
        $stmt->execute($arguments);
        $pdo=null;
    }

    public function delete(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("DELETE from `baiviet`WHERE ma_bviet=:mabaiviet");
        $stmt->execute($arguments);
        $pdo=null;
    }
}
?>
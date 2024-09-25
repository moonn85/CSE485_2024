<?php
require_once('config/database.php');
require_once('models/User.php');
class UserService{

    public function getAll($sql){
        $database = new Database;
        $pdo = $database->getConn();   //khởi tạo đối tượng PDO
        $stmt = $pdo->query($sql);

        $users = [];
        while($row = $stmt->fetch()){
            $user = new User($row['ma_ndung'],$row['username'],$row['password']);
            array_push($users,$user);
        }
        $pdo=null; //đóng kết nối
        return $users;
    }

    public function getById($arguments){
        $database = new Database;
        $pdo = $database->getConn();   //khởi tạo đối tượng PDO
        $stmt = $pdo->prepare('SELECT * FROM nguoidung WHERE ma_ndung = :manguoidung');
        $stmt->execute($arguments);

        $row = $stmt->fetch();
        $user = new User($row['ma_ndung'],$row['username'],$row['password']);

        $pdo=null; //đóng kết nối
        return $user;
    }

    public function insert(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("INSERT INTO `nguoidung`(`ma_ndung`, `username`, `password`) VALUES (null,:user,:pass)");
        $stmt->execute($arguments);
        $pdo=null;
    }

    public function update(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("UPDATE `nguoidung` SET  `username`=:user, `password`=:pass WHERE ma_ndung=:id_user");
        $stmt->execute($arguments);
        $pdo=null;
    }

    public function delete(array $arguments){
        $database = new Database;
        $pdo = $database->getConn();

        $stmt = $pdo->prepare("DELETE FROM `nguoidung`WHERE ma_ndung=:id_user");
        $stmt->execute($arguments);
        $pdo=null;
    }
}
?>
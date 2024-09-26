<!--file model bài viết -->
<?php
class ArticleModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function checkAuthorExists($maTG) {
        $sql = "SELECT ma_tgia FROM tacgia WHERE ma_tgia = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $maTG);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function checkCategoryExists($maTL) {
        $sql = "SELECT ma_tloai FROM theloai WHERE ma_tloai = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $maTL);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function addArticle($title, $song, $maTL, $sumary, $noidung, $maTG, $ngay, $img) {
        $sql = "INSERT INTO baiviet(tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssississ", $title, $song, $maTL, $sumary, $noidung, $maTG, $ngay, $img);
        return $stmt->execute();
    }
    public function deleteArticle($id) {
        $sql = "DELETE FROM baiviet WHERE ma_bviet = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function updateArticle($title, $song, $maTL, $sumary, $noidung, $maTG, $ngay, $img, $id) {
        $sql = "UPDATE baiviet SET tieude=?, ten_bhat=?, ma_tloai=?, tomtat=?, noidung=?, ma_tgia=?, ngayviet=?, hinhanh=?  
                  WHERE ma_bviet=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param("ssississi", $title, $song, $maTL, $sumary, $noidung, $maTG, $ngay, $img, $id);
        return $stmt->execute();
    }
}

?>
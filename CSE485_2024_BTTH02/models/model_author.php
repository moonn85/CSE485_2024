<!--file model tác giả -->
<?php
// models/model_author.php
class AuthorModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function addAuthor($author_name, $authorImg) {
        $sql = "INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param("ss", $author_name, $authorImg);
        return $stmt->execute();
    }
    public function checkArticlesByAuthor($id) {
        $sql = "SELECT * FROM baiviet WHERE ma_tgia = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Xóa tác giả dựa trên mã tác giả
    public function deleteAuthor($id) {
        $sql = "DELETE FROM tacgia WHERE ma_tgia = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function updateAuthor($author_name, $authorImg, $id) {
        $sql = "UPDATE tacgia SET ten_tgia = ?, hinh_tgia = ? WHERE ma_tgia = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param("ssi", $author_name, $authorImg, $id);
        return $stmt->execute();
    }
}

?>
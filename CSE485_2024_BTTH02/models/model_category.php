<!--file model thể loại -->
<?php
// models/model_category.php
class CategoryModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function addCategory($category_name) {
        $sql = "INSERT INTO theloai (ten_tloai) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param("s", $category_name);
        return $stmt->execute();
    }
    public function checkArticlesByCategory($id) {
        $sql = "SELECT * FROM baiviet WHERE ma_tloai = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Xóa thể loại dựa trên mã thể loại
    public function deleteCategory($id) {
        $sql = "DELETE FROM theloai WHERE ma_tloai = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function updateCategory($category_name, $id) {
        $sql = "UPDATE theloai SET ten_tloai = ? WHERE ma_tloai = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param("si", $category_name, $id);
        return $stmt->execute();
    }
}

?>
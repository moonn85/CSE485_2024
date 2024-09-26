<?php
session_start();
include '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/connection.php';
    require_once '../models/model_article.php';
    require_once '../models/model_author.php';
    require_once '../models/model_category.php';

    $userName = $_POST['username'];
    $pw = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $temp = $conn->prepare($sql);
    $temp->bind_param("s", $userName);
    $temp->execute();
    $result = $temp->get_result();
    
    if ($result->num_rows > 0) {
        $users = $result->fetch_assoc();        
        if (password_verify($pw, $users['password'])) {
            $_SESSION['username'] = $userName;  
            header("Location: ../views/admin"); 
            exit();
        } else {
            $error = "Sai mật khẩu!";
        }
    } else {
        $error = "Không tìm thấy người dùng!";
    }

    $temp->close();
}
?>

<?php
if (isset($error)) {
    echo "<script>alert('$error'); window.history.back();</script>";
}
?>

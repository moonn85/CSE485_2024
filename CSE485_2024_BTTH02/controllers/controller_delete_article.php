<?php
require '../config/connection.php'; 
require '../models/model_article.php';

$articleModel = new ArticleModel($conn);

$id = $_GET['id'];

if (!empty($id)) {
    if ($articleModel->deleteArticle($id)) {
        $message_success = "Xóa thông tin thành công";
        $redirectUrl_success = "../views/admin/article.php";
        echo "<script type='text/javascript'>alert('$message_success');";
        echo "window.location.href = '$redirectUrl_success';";
        echo "</script>;";
    } else {
        $message_error_query = "Lỗi query: " . $conn->error;
        $redirectUrl_error_query = "../views/admin/article.php";
        echo "<script type='text/javascript'>alert('$message_error_query');";
        echo "window.location.href = '$redirectUrl_error_query';";
        echo "</script>;";
    }
} else {
    $message_missing_id = "Không tìm thấy ID bài viết!";
    $redirectUrl_missing_id = "../views/admin/article.php";
    echo "<script type='text/javascript'>alert('$message_missing_id');";
    echo "window.location.href = '$redirectUrl_missing_id';";
    echo "</script>;";
}
        
?>
<?php 
require '../config/connection.php'; 
require '../models/model_author.php';

$authorModel = new AuthorModel($conn);

$id = $_GET['id'];

if ($authorModel->checkArticlesByAuthor($id)) {
    $message_error_constraint = "Vui lòng xóa bài viết có mã tác giả là " . $id . " rồi mới được xóa tác giả này";
    $redirectUrl_error_constraint = "../views/admin/article.php";
    echo "<script type='text/javascript'>alert('$message_error_constraint');";
    echo "window.location.href = '$redirectUrl_error_constraint';";
    echo "</script>;";
} else {
    if ($authorModel->deleteAuthor($id)) {
        $message_success = "Xóa thông tin thành công";
        $redirectUrl_success = "../views/admin/author.php";
        echo "<script type='text/javascript'>alert('$message_success');";
        echo "window.location.href = '$redirectUrl_success';";
        echo "</script>;";
    } else {
        $message_error_query = "Lỗi query: " . $conn->error;
        $redirectUrl_error_query = "../views/admin/author.php";
        echo "<script type='text/javascript'>alert('$message_error_query');";
        echo "window.location.href = '$redirectUrl_error_query';";
        echo "</script>;";
    }
}

?>

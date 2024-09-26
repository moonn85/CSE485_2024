<?php 
require '../config/connection.php'; 
require '../models/model_author.php'; 

$authorModel = new AuthorModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author_name = $_POST['txtAuthorName'];
    $authorImg = $_POST['imgAuthor'];
    $id = $_POST['txtAuthorId'];

    if (!empty($author_name) && !empty($authorImg)) {
        if ($authorModel->updateAuthor($author_name, $authorImg, $id)) {
            $message_success = "Chỉnh sửa thông tin thành công";
            $redirectUrl_success = "../views/admin/author.php";
            echo "<script type='text/javascript'>alert('$message_success');";
            echo "window.location.href = '$redirectUrl_success';";
            echo "</script>;";
        } else {
            $message_error_query = "Lỗi truy vấn: " . $conn->error;
            $redirectUrl_error_query = "../views/admin/author.php";
            echo "<script type='text/javascript'>alert('$message_error_query');";
            echo "window.location.href = '$redirectUrl_error_query';";
            echo "</script>;";
        }
    } else {
        $message_missing_required = "Yêu cầu nhập đủ thông tin!";
        $redirectUrl_missing_required = "../views/admin/edit_author.php?id=" . $id;
        echo "<script type='text/javascript'>alert('$message_missing_required');";
        echo "window.location.href = '$redirectUrl_missing_required';";
        echo "</script>;";
    }
}

?>
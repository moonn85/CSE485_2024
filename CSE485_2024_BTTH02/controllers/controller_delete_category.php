<?php 
require '../config/connection.php'; 
require '../models/model_category.php'; 

$categoryModel = new CategoryModel($conn);

$id = $_GET['id'];

if ($categoryModel->checkArticlesByCategory($id)) {
    $message_error_constraint = "Vui lòng xóa bài viết có mã thể loại là " . $id . " rồi mới được xóa thể loại này";
    $redirectUrl_error_constraint = "../views/admin/article.php";
    echo "<script type='text/javascript'>alert('$message_error_constraint');";
    echo "window.location.href = '$redirectUrl_error_constraint';";
    echo "</script>;";
} else {
    if ($categoryModel->deleteCategory($id)) {
        $message_success = "Xóa thông tin thành công";
        $redirectUrl_success = "../views/admin/category.php";
        echo "<script type='text/javascript'>alert('$message_success');";
        echo "window.location.href = '$redirectUrl_success';";
        echo "</script>;";
    } else {
        $message_error_query = "Lỗi query: " . $conn->error;
        $redirectUrl_error_query = "../views/admin/category.php";
        echo "<script type='text/javascript'>alert('$message_error_query');";
        echo "window.location.href = '$redirectUrl_error_query';";
        echo "</script>;";
    }
}

?>

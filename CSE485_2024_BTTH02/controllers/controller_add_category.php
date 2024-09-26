<?php  
    // controllers/controller_add_category.php
require '../config/connection.php'; // Kết nối cơ sở dữ liệu
require '../models/model_category.php'; // Gọi model của thể loại

$categoryModel = new CategoryModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['txtCatName'];

    if (!empty($category_name)) {
        if ($categoryModel->addCategory($category_name)) {
            $message_success = "Thêm thông tin thành công";
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
    } else {
        $message_missing_required = "Yêu cầu nhập đủ thông tin!";
        $redirectUrl_missing_required = "../views/admin/add_category.php";
        echo "<script type='text/javascript'>alert('$message_missing_required');";
        echo "window.location.href = '$redirectUrl_missing_required';";
        echo "</script>;";
    }
}

?>
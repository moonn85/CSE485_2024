<?php 
require '../config/connection.php'; 
require '../models/model_category.php'; 

$categoryModel = new CategoryModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['txtCatName'];
    $id = $_POST['txtCatId'];

    if (!empty($category_name)) {
        if ($categoryModel->updateCategory($category_name, $id)) {
            $message_success = "Chỉnh sửa thông tin thành công";
            $redirectUrl_success = "../views/admin/category.php";
            echo "<script type='text/javascript'>alert('$message_success');";
            echo "window.location.href = '$redirectUrl_success';";
            echo "</script>;";
        } else {
            $message_error_query = "Lỗi truy vấn: " . $conn->error;
            $redirectUrl_error_query = "../views/admin/category.php";
            echo "<script type='text/javascript'>alert('$message_error_query');";
            echo "window.location.href = '$redirectUrl_error_query';";
            echo "</script>;";
        }
    } else {
        $message_missing_required = "Yêu cầu nhập đủ thông tin!";
        $redirectUrl_missing_required = "../views/admin/edit_category.php?id=" . $id;
        echo "<script type='text/javascript'>alert('$message_missing_required');";
        echo "window.location.href = '$redirectUrl_missing_required';";
        echo "</script>;";
    }
}

?>
<?php 
    include '../config/connection.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $category_name = $_POST['txtCatName'];
        $id = $_POST['txtCatId'];
        if (!empty($category_name)){
            $sql = "UPDATE theloai SET ten_tloai = ? where ma_tloai = ?";
            $temp = $conn -> prepare($sql);
            if ($temp === false){
                $message_error_query = "Lỗi truy vấn: ";
                $redirectUrl_error_query = "../views/admin/category.php";
                
                echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
                echo " window.location.href = '$redirectUrl_error_query';";
                echo "</script>;";
            }

            $temp->bind_param("si",$category_name,$id);
            
            if ($temp -> execute()){
                $message_success = "Chỉnh sửa thông tin thành công";
                $redirectUrl_success = "../views/admin/category.php";
                echo "<script type='text/javascript'>alert('$message_success');";
                echo " window.location.href = '$redirectUrl_success';";
                echo "</script>;";
            }
            else{
                $message_error_execute = "Lỗi truy vấn: ";
                $redirectUrl_error_execute = "../views/admin/edit_category.php?id=".$id;
                echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
                echo " window.location.href = '$redirectUrl_error_execute';";
                echo "</script>;";
            }
            $temp -> close();
        }
        else{
            $message_missing_required = "Yêu cầu nhập đủ thông tin!";
            $redirectUrl_missing_required = "../views/admin/edit_category.php?id=".$id;
            echo "<script type='text/javascript'>alert('$message_missing_required');";
            echo " window.location.href = '$redirectUrl_missing_required';";
            echo "</script>;";
        } 
    }
?>
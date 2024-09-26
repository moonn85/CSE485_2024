<?php
    include '../config/connection.php';

    $id = $_GET['id'];
    
    $sql = "DELETE from baiviet WHERE ma_bviet = ?";
    $temp = $conn -> prepare($sql);
    if($temp === false){
        $message_error_query = "Lỗi query: ";
        $redirectUrl_error_query = "../views/admin/article.php";
        
        echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
        echo " window.location.href = '$redirectUrl_error_query';";
        echo "</script>;";
    }

    $temp -> bind_param("i",$id);

    if ($temp -> execute()){
        $message_success = "Xóa thông tin thành công";
        $redirectUrl_success = "../views/admin/article.php";
        echo "<script type='text/javascript'>alert('$message_success');";
        echo " window.location.href = '$redirectUrl_success';";
        echo "</script>;";
    }
    else{
        $message_error_execute = "Lỗi execute: ";
        $redirectUrl_error_execute = "../views/admin/article.php?id=".$id;
        echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
        echo " window.location.href = '$redirectUrl_error_execute';";
        echo "</script>;";
    }
    $temp -> close();        
?>
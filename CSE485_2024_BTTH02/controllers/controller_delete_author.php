<?php 
    include '../config/connection.php';
    $id = $_GET['id'];
    $sql_check = "SELECT * from baiviet where ma_tgia = " . $id;
    $result = $conn -> query($sql_check);
    if ($result -> num_rows != 0){
        $message_error_constraint = "Vui lòng xóa bài viết có mã tác giả là " . $id . " rồi mới được xóa tác giả này";
        $redirectUrl_error_constraint = "../views/admin/article.php";
        echo "<script type='text/javascript'>alert('$message_error_constraint');";
        echo " window.location.href = '$redirectUrl_error_constraint';";
        echo "</script>;";
    }
    else{
        $sql = "DELETE from tacgia WHERE ma_tgia = ?";
        $temp = $conn -> prepare($sql);
        if($temp === false){
            $message_error_query = "Lỗi query: ";
            $redirectUrl_error_query = "../views/admin/author.php";
            echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
            echo " window.location.href = '$redirectUrl_error_query';";
            echo "</script>;";
        }

        $temp -> bind_param("i",$id);
        
        if ($temp -> execute()){
            $message_success = "Xóa thông tin thành công";
            $redirectUrl_success = "../views/admin/author.php";
            echo "<script type='text/javascript'>alert('$message_success');";
            echo " window.location.href = '$redirectUrl_success';";
            echo "</script>;";
        }
        else{
            $message_error_execute = "Lỗi execute: ";
            $redirectUrl_error_execute = "../views/admin/author.php?id=".$id;
            echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
            echo " window.location.href = '$redirectUrl_error_execute';";
            echo "</script>;";
        }
        $temp -> close();
    }
?>

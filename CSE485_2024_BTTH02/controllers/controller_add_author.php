<?php  
        include '../config/connection.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $author_name = $_POST['txtAuthorName'];
            $authorImg = $_POST['imgAuthor'];
            if (!empty($author_name) && !empty($authorImg)){
                $sql = "INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES (?,?)";
                $temp = $conn -> prepare($sql);
                if ($temp === false){
                    $message_error_query = "Lỗi truy vấn: ";
                    $redirectUrl_error_query = "../views/admin/author.php";
                    echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
                    echo " window.location.href = '$redirectUrl_error_query';";
                    echo "</script>;";
                }

                $temp->bind_param("ss",$author_name,$authorImg);
                
                if ($temp -> execute()){
                    $message_success = "Thêm thông tin thành công";
                    $redirectUrl_success = "../views/admin/author.php";
                    echo "<script type='text/javascript'>alert('$message_success');";
                    echo " window.location.href = '$redirectUrl_success';";
                    echo "</script>;";
                }
                else{
                    $message_error_execute = "Lỗi truy vấn: ";
                    $redirectUrl_error_execute = "../views/admin/add_author.php";
                    echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
                    echo " window.location.href = '$redirectUrl_error_execute';";
                    echo "</script>;";
                }
                $temp -> close();
            }
            else{
                $message_missing_required = "Yêu cầu nhập đủ thông tin!";
                $redirectUrl_missing_required = "../views/admin/add_author.php";
                echo "<script type='text/javascript'>alert('$message_missing_required');";
                echo " window.location.href = '$redirectUrl_missing_required';";
                echo "</script>;";
            } 
        }
?>
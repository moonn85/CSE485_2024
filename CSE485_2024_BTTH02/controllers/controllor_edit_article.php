<<?php 
    // controllers/controller_edit_article.php
require '../config/connection.php'; // Kết nối cơ sở dữ liệu
require '../models/model_article.php'; // Gọi model của bài viết

$articleModel = new ArticleModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['tieude'];
    $song = $_POST['bhat'];
    $sumary = $_POST['tomtat'];
    $maTG = $_POST['tacgia'];
    $maTL = $_POST['theloai'];
    $ngay = $_POST['ngay'];
    $id = $_POST['bviet'];
    $img = $_POST['img'];
    $noidung = $_POST['noidung'];

    if (!empty($title) && !empty($song) && !empty($sumary) && !empty($maTG) && !empty($maTL) && !empty($ngay) && !empty($img) && !empty($noidung)) {
        if ($articleModel->updateArticle($title, $song, $maTL, $sumary, $noidung, $maTG, $ngay, $img, $id)) {
            $message_success = "Chỉnh sửa thành công";
            $redirectUrl_success = "../views/admin/article.php";
            echo "<script type='text/javascript'>alert('$message_success');";
            echo "window.location.href = '$redirectUrl_success';";
            echo "</script>;";
        } else {
            $message_error_query = "Lỗi truy vấn: " . $conn->error;
            $redirectUrl_error_query = "../views/admin/article.php";
            echo "<script type='text/javascript'>alert('$message_error_query');";
            echo "window.location.href = '$redirectUrl_error_query';";
            echo "</script>;";
        }
    } else {
        $message_missing_required = "Yêu cầu nhập đủ thông tin!";
        $redirectUrl_missing_required = "../views/admin/edit_article.php?id=" . $id;
        echo "<script type='text/javascript'>alert('$message_missing_required');";
        echo "window.location.href = '$redirectUrl_missing_required';";
        echo "</script>;";
    }
}

?>

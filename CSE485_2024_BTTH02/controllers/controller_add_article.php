<?php
require '../config/connection.php'; // Kết nối cơ sở dữ liệu
require '../models/model_article.php'; // Import model xử lý bài viết

$articleModel = new ArticleModel($conn); // Khởi tạo model

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['tieude'];
    $song = $_POST['bhat'];
    $sumary = $_POST['tomtat'];
    $maTG = $_POST['tacgia'];
    $maTL = $_POST['theloai'];
    $ngay = $_POST['ngay'];
    $noidung = $_POST['noidung'];
    $img = $_POST['img'];

    if (!empty($title) && !empty($song) && !empty($sumary) && !empty($maTG) && !empty($maTL) && !empty($ngay) && !empty($noidung) && !empty($img)) {
        // Kiểm tra mã tác giả và thể loại
        $check_tgia = $articleModel->checkAuthorExists($maTG);
        $check_theloai = $articleModel->checkCategoryExists($maTL);

        if (!$check_tgia || !$check_theloai) {
            echo "<script>alert('Yêu cầu nhập mã tác giả hoặc mã thể loại đã tồn tại'); window.location.href='../views/admin/add_article.php';</script>";
        } else {
            // Thêm bài viết
            if ($articleModel->addArticle($title, $song, $maTL, $sumary, $noidung, $maTG, $ngay, $img)) {
                echo "<script>alert('Thêm thông tin thành công'); window.location.href='../views/admin/article.php';</script>";
            } else {
                echo "<script>alert('LỖI QUERRY: " . $conn->error . "'); window.location.href='../views/admin/article.php';</script>";
            }
        }
    } else {
        echo "<script>alert('YÊU CẦU NHẬP ĐỦ THÔNG TIN!'); window.location.href='../views/admin/add_article.php';</script>";
    }
}

?>
<?php
require 'connection.php';

$result = mysqli_query($conn, "SELECT * FROM theloai");
$types = mysqli_fetch_all($result, MYSQLI_ASSOC);

$result = mysqli_query($conn, "SELECT * FROM tacgia");
$authors = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['tieude']) && isset($_POST['ten_bhat']) && isset($_POST['ten_tloai'])  && isset($_POST['tomtat']) && isset($_POST['noidung']) && isset($_POST['ten_tgia']) && isset($_POST['ngayviet'])) {
    $tieude = $_POST['tieude'];
    $ten_bhat = $_POST['ten_bhat'];
    $ten_tloai = $_POST['ten_tloai'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $ten_tgia = $_POST['ten_tgia'];
    $ngayviet = $_POST['ngayviet'];
    $hinhanh = isset($_POST['hinhanh']) ? $_POST['hinhanh'] : '';

    // Kiểm tra nếu loại bài viết tồn tại trong bảng theloai
    $sql_check_type = "SELECT * FROM theloai WHERE ma_tloai = ?";
    $stmt_check_type = mysqli_prepare($conn, $sql_check_type);
    mysqli_stmt_bind_param($stmt_check_type, 'i', $ten_tloai);
    mysqli_stmt_execute($stmt_check_type);
    $result_check_type = mysqli_stmt_get_result($stmt_check_type);

    if (mysqli_num_rows($result_check_type) == 0) {
        echo "<script>alert('Loại bài viết không tồn tại trong cơ sở dữ liệu.')</script>";
    } else {
        // Thực hiện câu lệnh INSERT nếu loại bài viết tồn tại
        $sql = "INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssisisss', $tieude, $ten_bhat, $ten_tloai, $tomtat, $noidung, $ten_tgia, $ngayviet, $hinhanh);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Thêm thành công')</script>";
                header('location: article.php');
            } else {
                echo "<script>alert('Thêm thất bại: " . mysqli_error($conn) . "')</script>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Câu lệnh SQL không hợp lệ: " . mysqli_error($conn) . "')</script>";
        }
    }

    mysqli_stmt_close($stmt_check_type);
}

// Đóng kết nối
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css' rel='stylesheet' type='text/css'>
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'></script>
</head>

<body>
   <?php include 'header.php'?>
    <main class="container mt-5 mb-5">
        <form method="post">
            <div class="row">
                <div class="col-sm">
                    <h3 class="text-center text-uppercase fw-bold">Thêm bài viết mới</h3>
                        <div class="input-group mt-3 mb-3">
                            <span class="input-group-text" id="tieude">Tiêu đề</span>
                            <input type="text" class="form-control" name="tieude">
                        </div>
                        <div class="input-group mt-3 mb-3">
                            <span class="input-group-text" id="ten_bhat">Tên bài hát</span>
                            <input type="text" class="form-control" name="ten_bhat">
                        </div>
                        <div class="input-group mt-3 mb-3">
                            <span class="input-group-text">Tên thể loại</span>
                            <select id='ten_tloai' style="width:250px" name="ten_tloai">
                                <option value='-1'>Chọn tên thể loại</option>
                                <?php
                                    foreach ($types as $type) {
                                ?>
                                    <option value="<?= $type['ma_tloai'] ?>"><?= $type['ten_tloai'] ?></option>
                                <?php
                                    };
                                ?>
                            </select>
                        </div>
                        <div class="input-group mt-3 mb-3">
                            <span class="input-group-text" id="tomtat">Tóm tắt</span>
                            <input type="text" class="form-control" name="tomtat">
                        </div>
                        <div class="input-group mt-3 mb-3">
                            <span class="input-group-text" id="noidung">Nội dung</span>
                            <input type="text" class="form-control" name="noidung">
                        </div>
                        <div class="input-group mt-3 mb-3">
                            <span class="input-group-text">Tên tác giả</span>
                            <select id='ten_tgia' style="width:250px" name="ten_tgia">
                                <option value='-1'>Chọn tên tác giả</option>
                                <?php
                                    foreach ($authors as $author) {
                                ?>
                                    <option value="<?= $author['ma_tgia'] ?>"><?= $author['ten_tgia'] ?></option>
                                <?php
                                    };
                                ?>
                            </select>
                        </div>
                        <div class="input-group mt-3 mb-3">
                            <span class="input-group-text" id="ngayviet">Ngày viết</span>
                            <input name="ngayviet" type="datetime-local" id="myDatetimeField" style="border : 1px solid var(--bs-border-color)" />
                        </div>
                        <div class="input-group mt-3 mb-3">
                            <span class="input-group-text" id="hinhanh">Hình ảnh</span>
                            <input type="file" class="form-control" name="hinhanh">
                        </div>
                        <div class="form-group  float-end ">
                            <input type="submit" value="Thêm" class="btn btn-success">
                            <a href="category.php" class="btn btn-warning ">Quay lại</a>
                        </div>
                </div>
            </div>
        </form>

    </main>
    <?php include 'footer.php'?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</html>

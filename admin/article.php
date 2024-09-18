<?php
require "connection.php";
$sql       = "SELECT * FROM baiviet order by ngayviet desc";
$result = mysqli_query($conn, $sql);
$members = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
</head>

<body>
<?php include 'header.php'?>

    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <a href="add_article.php" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề </th>
                            <th scope="col">Tên bài hát </th>
                            <th scope="col">Mã thể loại </th>
                            <th scope="col">Tóm tắt </th>
                            <th scope="col">Nội dung </th>
                            <th scope="col">Mã tác giả </th>
                            <th scope="col">Hình ảnh</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 1;
                        foreach ($members as $member) : ?>
                            <tr>
                                <th scope="row"><?php echo $index ?></th>
                                <td><?php echo $member['tieude'] ?></td>
                                <td><?php echo $member['ten_bhat'] ?></td>
                                <td><?php echo $member['ma_tloai'] ?></td>
                                <td><?php echo $member['tomtat'] ?></td>
                                <td><?php echo $member['noidung'] ?></td>
                                <td><?php echo $member['ma_tgia'] ?></td>
                                <td><?php echo $member['hinhanh'] ?></td>
                                <td><a href="edit_article.php?id=<?php echo $member['ma_bviet'] ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                                <td><a href="delete_article.php?id=<?php echo $member['ma_bviet'] ?>" class="btn btn-danger">Xóa</a></td>
                            </tr>
                        <?php
                            $index++;
                            endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include 'footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
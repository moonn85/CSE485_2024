<?php
require_once('views/layouts/header_admin.php');
?>

<main class="container">
    <form action="" method="post"
        style="width: 50%; background: #3d456a2e; border: 1px solid; border-radius: 10px; margin: 60px auto; padding: 30px;">
        <h3 style="margin-bottom: 30px">
            <?php 
            if (!isset($_GET['list_id'])) echo "Bạn có chắc muốn xóa sản phẩm này không"; 
            else echo "Bạn cần xóa các bài biết có mã là: ".$_GET['list_id']." trước khi xóa thể loại có mã = ".$_GET['id']; 
            ?>
        </h3>
        <div>
            <a href="?controller=article" class="btn btn-success" style="display: <?php if (!isset($_GET['list_id'])) echo 'none' ?>;">quay lại trang quản lý bài viết</a>
            <input class="btn btn-danger" type="submit" name='confirm' value="xóa" style="display: <?php if (isset($_GET['list_id'])) echo 'none' ?>;">
            <a href="?controller=category" class="btn btn-warning" >quay lại</a>
        </div>
    </form>
</main>

<?php
require_once('views/layouts/footer.php');
?>
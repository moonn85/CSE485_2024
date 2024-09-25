<?php
require_once('views/layouts/header_admin.php');
?>
<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">Thêm mới người dùng</h3>
            <form action="" method="post">
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">username</span>
                    <input type="text" class="form-control" name="user" value="<?= $_GET['u1'] ?? '' ?>">
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">password</span>
                    <input type="password" class="form-control" name="pass" value="<?= $_GET['p1'] ?? '' ?>">
                </div>

                <div class="input-group mt-3 mb-3" style="color: #ab0000; font-size: 15px; margin:10px;font-style: italic;">
                    <?= $_GET['notification'] ?? "" ?>
                </div>

                <div class="form-group  float-end ">
                    <input type="submit" name="btn" value="thêm" class="btn btn-success">
                    <a href="?controller=user" class="btn btn-warning ">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php
require_once('views/layouts/footer.php');
?>
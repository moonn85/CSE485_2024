<?php
require_once('views/layouts/header_admin.php');
$arguments['manguoidung'] = $_GET['id'];
$user = $userService->getById($arguments);

?>
<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">Sửa thông tin người dùng</h3>
            <form action="" method="post">
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">Mã người dùng</span>
                    <input type="text" class="form-control" name="id_user" readonly value="<?= $user->getMaNDung() ?>">
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">username</span>
                    <input type="text" class="form-control" name="user" value="<?= $user->getUserName() ?>">
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">password</span>
                    <input type="text" class="form-control" name="pass" value="<?= $user->getPassWord() ?>">
                </div>

                <div class="input-group mt-3 mb-3" style="color: #ab0000; font-size: 15px; margin:10px;font-style: italic;">
                    <?= $_GET['notification'] ?? "" ?>
                </div>

                <div class="form-group  float-end ">
                    <input type="submit" name="btn" value="sửa" class="btn btn-success">
                    <a href="?controller=user" class="btn btn-warning ">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php
require_once('views/layouts/footer.php');
?>
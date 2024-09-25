<?php
require_once('views/layouts/header_admin.php');
?>
<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm-3">
            <div class="card mb-2" style="width: 100%;height: auto;">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a href="?controller=user" class="text-decoration-none">Người dùng</a>
                    </h5>

                    <h5 class="h1 text-center">
                        <?= $so_luong_nguoidung ?>
                    </h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card mb-2" style="width: 100%;height: auto;">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a href="?controller=category" class="text-decoration-none">Thể loại</a>
                    </h5>

                    <h5 class="h1 text-center">
                        <?= $so_luong_theloai ?>
                    </h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card mb-2" style="width: 100%;height: auto;">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a href="?controller=author" class="text-decoration-none">Tác giả</a>
                    </h5>

                    <h5 class="h1 text-center">
                        <?= $so_luong_tacgia ?>
                    </h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card mb-2" style="width: 100%;height: auto;">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a href="?controller=article" class="text-decoration-none">Bài viết</a>
                    </h5>

                    <h5 class="h1 text-center">
                        <?= $so_luong_baiviet ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
require_once('views/layouts/footer.php');
?>
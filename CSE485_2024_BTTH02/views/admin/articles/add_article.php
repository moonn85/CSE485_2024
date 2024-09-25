<?php
require_once('views/layouts/header_admin.php');
?>
<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">THÊM MỚI BÀI VIẾT</h3>
            <h5 style="color:red"><?= $_GET['mess'] ?? "" ?></h5>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName" style="width: 120px;">Tiêu đề </span>
                    <input type="text" class="form-control" name="tieude">
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName1" style="width: 120px;">Tên bài hát</span>
                    <input type="text" class="form-control" name="ten_bhat">
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId1" style="width: 120px;">Tên thể loại</span>
                    <select name="ten_tloai" id="cars" class="form-control">
                        <?php
                        $categories = $categoryService->getAll("select * from theloai");
                        foreach ($categories as $category) {
                            ?>
                            <option value="<?= $category->getTenTheLoai() ?>"><?= $category->getTenTheLoai() ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId1" style="width: 120px;">Tên tác giả</span>
                    <select name="ten_tgia" id="cars" class="form-control">
                        <?php
                        $authors = $authorService->getAll(" select * from tacgia");
                        foreach ($authors as $author) {
                            ?>
                            <option value="<?= $author->getTenTGia() ?>"><?= $author->getTenTGia() ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId1" style="width: 120px;">Tóm tắt</span>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="tomtat"></textarea>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId1" style="width: 120px;">Nội dung</span>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="noidung"></textarea>
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId1" style="width: 120px;">Thêm hình ảnh</span>
                    <input type="file" class="form-control m-3" name="hinhanh" id="image"><br>
                </div>

                <div class="form-group  float-end ">
                    <input type="submit" name="btn" value="thêm" class="btn btn-success">
                    <a href="?controller=article" class="btn btn-warning ">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php
require_once('views/layouts/footer.php');
?>
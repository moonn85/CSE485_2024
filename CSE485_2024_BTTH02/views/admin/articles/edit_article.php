<?php
require_once('views/layouts/header_admin.php');

if (isset($_GET['id']))
    $arguments['mabaiviet']=$_GET['id'];
    $articles = $articleService->getById($arguments);
?>
<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">SỬA THÔNG TIN BÀI VIẾT</h3>
            <h5 style="color:red"><?= $_GET['mess'] ?? "" ?></h5>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId" style="width:120px;">Mã bài viết</span>
                    <input type="text" class="form-control" name="ma_bviet" readonly
                        value="<?= $articles->getMaBViet() ?? '' ?>">
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName" style="width: 120px;">Tiêu đề </span>
                    <input type="text" class="form-control" name="tieude" value="<?= $articles->getTieuDe() ?? '' ?>">
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName1" style="width: 120px;">Tên bài hát</span>
                    <input type="text" class="form-control" name="ten_bhat"
                        value="<?= $articles->getTenBHat() ?? '' ?> ">
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId1" style="width: 120px;">Tên thể loại</span>
                    <select name="ten_tloai" id="cars" class="form-control">
                        <?php
                        $categories = $categoryService->getAll(" select * from theloai");
                        foreach ($categories as $category) {
                            ?>
                            <option value="<?= $category->getTenTheLoai() ?>" <?php if ($articles->getMaTLoai() == $category->getMaTheLoai()) echo 'selected' ?>>
                                <?=$category->getTenTheLoai()?>
                            </option>
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
                            <option value="<?= $author->getTenTGia() ?>" <?php if ($articles->getMaTGia() == $author->getMaTGia())
                                  echo 'selected' ?>><?= $author->getTenTGia() ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId1" style="width: 120px;">Tóm tắt</span>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="tomtat"><?= $articles->getTomTat() ?? '' ?></textarea>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId1" style="width: 120px;">Nội dung</span>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="noidung"><?= $articles->getNoiDung() ?? '' ?></textarea>
                </div>

                <div style="width: 20%; margin: auto;"><img src="assets/images/songs/<?= $articles->getHinhAnh() ?? ''?>" alt="chưa có hình ảnh" style="width: 100%; border: 4px solid #1c16c1;">
                        <span><?= $articles->getHinhAnh() ?? "" ?></span>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId1" style="width: 120px;">Sửa hình ảnh</span>
                    <input type="file" class="form-control m-3" name="hinhanh" id="image" value="<?= $articles->getHinhAnh() ?? '' ?> "><br>
                </div>

                <div class="form-group  float-end ">
                    <input type="submit" name="btn" value="lưu" class="btn btn-success">
                    <a href="?controller=article" class="btn btn-warning ">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php
require_once('views/layouts/footer.php');
?>
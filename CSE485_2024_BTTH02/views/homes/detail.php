<?php
$link_css_login = "";
include("views/layouts/header_home.php");

$articles = $articleService->getAll('select baiviet.*, theloai.ten_tloai, tacgia.ten_tgia from baiviet, theloai, tacgia where baiviet.ma_bviet ='.$_GET['id_article'].' and baiviet.ma_tloai = theloai.ma_tloai and baiviet.ma_tgia=tacgia.ma_tgia;');

$path_img = ($articles[0]->getHinhAnh() == "")? "default.jpg":$articles[0]->getHinhAnh() ;


$authors = $authorService->getAll('select * from tacgia where ma_tgia = '.$articles[0]->getMaTGia());
?>

<main class="container mt-5">
    <div class="row mb-5">
        <div class="col-sm-4">
            <img src="assets/images/songs/<?= $path_img ?>" class="img-fluid" alt="...">
        </div>
        <div class="col-sm-8">
            <h5 class="card-title mb-2">
                <a href="" class="text-decoration-none"><?= $articles[0]->getTieuDe() ?></a>
            </h5>
            <p class="card-text"><span class=" fw-bold">Bài hát: </span><?= $articles[0]->getTenBHat() ?></p>
            <p class="card-text"><span class=" fw-bold">Thể loại: </span><?= $articles[0]->getMaTLoai() ?></p>
            <p class="card-text"><span class=" fw-bold">Tóm tắt: </span><?= $articles[0]->getTomTat() ?></p>
            <p class="card-text"><span class=" fw-bold">Nội dung: </span><?= $articles[0]->getNoiDung() ?></p>
            <p class="card-text"><span class=" fw-bold">Tác giả: </span><?= $authors[0]->getTenTGia() ?></p>
        </div>
    </div>
</main>

<?php
include("views/layouts/footer.php");
?>
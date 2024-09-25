<?php
$link_css_login = "";
include("views/layouts/header_home.php");
?>

<div id="carouselExampleIndicators" class="container carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/images/slideshow/slide01.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="assets/images/slideshow/slide02.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="assets/images/slideshow/slide03.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<main class="mt-3">
    <?php
    $categories = $categoryService->getAll('select * from theloai');
    
    $dem = 0;
    foreach ($categories as $category) {
        //khi chưa nhấn nút tìm kiếm
        if (!isset($_POST['search'])) {
            $sql = 'SELECT baiviet.* FROM baiviet,theloai WHERE baiviet.ma_tloai=theloai.ma_tloai and theloai.ten_tloai ="' . $category->getTenTheLoai() . '";';
        } else {
            $nodungcantim = $_POST['nodungcantim'];
            $sql = "SELECT baiviet.* FROM baiviet,theloai WHERE baiviet.ten_bhat LIKE '%$nodungcantim%' and baiviet.ma_tloai=theloai.ma_tloai and theloai.ten_tloai ='" . $category->getTenTheLoai() . "';";
        }
        $articles = $articleService->getAll($sql);

        if (count($articles) > 0) {
            $dem++;
            if ($dem % 2 == 0)
                $background = "#421698d4";
            else
                $background = "";
            ?>

            <div class="category" style="background-color: <?= $background ?>;">
                <h3 class="text-center text-uppercase">
                    <?= $category->getTenTheLoai()?>
                </h3>
                <div class="row container">
                    <?php
                    foreach ($articles as $article) {
                        $path_img = ($article->getHinhAnh() == "") ? "default.jpg" : $article->getHinhAnh();
                        ?>
                        <div class="col-sm-3">
                            <div class="card mb-2" style="width: 100%;">
                                <img src="assets/images/songs/<?= $path_img ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">
                                        <a href="?action=detail&id_article=<?= $article->getMaBViet() ?>" class="text-decoration-none">
                                            <?= $article->getTenBHat() ?>
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
    ?>
</main>
<?php
include("views/layouts/footer.php");
?>
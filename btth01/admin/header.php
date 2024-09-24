<?php
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    $navs = [
        ["label" => "Trang chủ", "route" => "."],
        ["label" => "Trang ngoài", "route" => "../index.php"],
        ["label" => "Thể loại", "route" => "category.php"],
        ["label" => "Tác giả", "route" => "author.php"],
        ["label" => "Bài viết", "route" => "article.php"],
    ];
?>
<header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        foreach ($navs as $nav) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $nav['route'] == $curPageName ? 'active' : ''  ?>" aria-current="page" href="<?= $nav['route'] ?>"><?= $nav['label'] ?></a>
                        </li>
                            <?php
                        }
                        ?>
                    </ul>
        </nav>
    </header>
<?php
require_once('views/layouts/header_admin.php');
?>

<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <a href="?controller=author&action=add_author" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên tác giả</th>
                        <th scope="col">Hình ảnh</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $authors = $authorService->getAll("SELECT * FROM tacgia"); //mảng 2 chiều
                    $dem = 1;
                    foreach ($authors as $author) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?= $dem++ ?>
                            </th>
                            <td>
                                <?= $author->getTenTGia() ?>
                            </td>
                            <td><img src="assets/images/songs/<?= $author->getHinhTGia() ?>" alt=""
                                    style="width: 100px;"></td>
                            <td>
                                <a href="?controller=author&action=edit_author&id=<?= $author->getMaTGia() ?>"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href="?controller=author&action=delete_author&id=<?= $author->getMaTGia() ?>"><i
                                        class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
require_once('views/layouts/footer.php');
?>

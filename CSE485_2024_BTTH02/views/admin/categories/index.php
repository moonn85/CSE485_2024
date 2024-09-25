<?php
require_once('views/layouts/header_admin.php');
?>
<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <a href="?controller=category&action=add_category" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên thể loại</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $dem = 1;
                        foreach($categories as $category){
                            ?>
                             <tr>
                            <th scope="row"><?=$dem++ ?></th>    
                            <td><?= $category->getTenTheLoai() ?></td>
                            <td>
                                <a href="?controller=category&action=edit_category&id=<?=$category->getMaTheLoai()?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href="?controller=category&action=delete_category&id=<?=$category->getMaTheLoai()?>"><i class="fa-solid fa-trash"></i></a>
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
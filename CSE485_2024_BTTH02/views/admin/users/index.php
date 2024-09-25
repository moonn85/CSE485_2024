<?php
require_once('views/layouts/header_admin.php');
?>
<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <a href="?controller=user&action=add_user" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">username</th>
                        <th scope="col">password</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $users = $userService->getAll('select * from nguoidung');
                    if (count($users) > 0) {
                        $dem = 1;
                        foreach ($users as $user) {
                            ?>
                            <tr>
                                <th scope="row"><?= $dem++ ?></th>
                                <td>
                                    <?= $user->getUserName() ?>
                                </td>
                                <td>
                                    <?= $user->getPassWord() ?>
                                </td>
                                <td>
                                    <a href="?controller=user&action=edit_user&id=<?= $user->getMaNDung() ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                                <td>
                                    <a href="?controller=user&action=delete_user&id=<?= $user->getMaNDung() ?>"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
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
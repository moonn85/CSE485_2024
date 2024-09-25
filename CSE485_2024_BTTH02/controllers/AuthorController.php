<?php
require_once('services/AuthorService.php');
require_once('services/ArticleService.php');

class AuthorController
{
    public function index()
    {
        $authorService = new AuthorService();
        include("views/admin/authors/index.php");
    }

    public function add_author()
    {
        $authorService = new AuthorService();

        $ten_tgia = trim($_POST['ten_tgia'] ?? ""); //nếu $_POST['ten_tgia'] tồn tại thì $ten_tgia = $_POST['ten_tgia'] nếu không $ten_tgia = ""
        $hinh_tgia = $_FILES['hinh_tgia']['name'] ?? ""; //lấy ra tên file, vd: picachu.png
        $ext = pathinfo($hinh_tgia, PATHINFO_EXTENSION); // Get extension (lấy ra đuôi file), vd: .png, .jpg
        $extensions = ['png', 'jpg'];

        if (isset($_POST['btn'])) {
            if (!empty($ten_tgia)) {
                $arguments['tentacgia'] = $ten_tgia;
                $arguments['hinhtacgia'] = $hinh_tgia;

                if (!empty($hinh_tgia)) {
                    if (in_array($ext, $extensions)) {
                        move_uploaded_file($_FILES['hinh_tgia']['tmp_name'], 'assets/images/songs/' . $hinh_tgia);

                        $authorService->insert($arguments);
                        header("location:?controller=author");
                    } else {
                        $mess = "Hình ảnh chỉ nhận file: .png, .jpg";
                        header("location:?controller=author&action=add_author&mess=$mess");
                    }
                } else {
                    $authorService->insert($arguments);
                    header("location:?controller=author");
                }
            } else {
                $mess = "Vui lòng kiểm tra lại thông tin. Tên tác giả không được bỏ trống.";
                header("location:?controller=author&action=add_author&mess=$mess");
            }
        }
        include("views/admin/authors/add_author.php");
    }

    public function edit_author()
    {
        $authorService = new AuthorService();

        $ma_tgia = $_POST['ma_tgia'] ?? ""; //ở from sửa gửi sang
        $ten_tgia = trim($_POST['ten_tgia'] ?? ""); //nếu $_POST['ten_tgia'] tồn tại thì $ten_tgia = $_POST['ten_tgia'] nếu không $ten_tgia = ""
        $hinh_tgia = $_FILES['hinh_tgia']['name'] ?? ""; //lấy ra tên file, vd: picachu.png
        $ext = pathinfo($hinh_tgia, PATHINFO_EXTENSION); // Get extension (lấy ra đuôi file), vd: .png, .jpg
        $extensions = ['png', 'jpg'];

        if (isset($_POST['btn'])) {
            if (!empty($ten_tgia)) {

                $image = $hinh_tgia;
                if (empty($hinh_tgia)) {
                    $argument['matacgia'] = $ma_tgia;
                    $image = $authorService->getById($argument)->getHinhTGia();
                } else {
                    if (in_array($ext, $extensions)) {
                        move_uploaded_file($_FILES['hinh_tgia']['tmp_name'], 'assets/images/songs/' . $hinh_tgia);
                    } else {
                        $mess = "Hình ảnh chỉ nhận file: .png, .jpg";
                        header("location:?controller=author&action=edit_author&id=$ma_tgia&mess=$mess");
                        die();
                    }
                }

                $arguments['tentacgia'] = $ten_tgia;
                $arguments['hinhtacgia'] = $image;
                $arguments['matacgia'] = $ma_tgia;

                $authorService->update($arguments);
                header("location:?controller=author");
            } else {
                $mess = "Vui lòng kiểm tra lại thông tin. Tên tác giả không được bỏ trống.";
                header("location:?controller=author&action=edit_author&id=$ma_tgia&mess=$mess");
            }
        }
        include("views/admin/authors/edit_author.php");
    }

    public function delete_author()
    {
        $authorService = new AuthorService();
        $articleService = new ArticleService();

        $ma_tgia = $_GET['id'];
        $articles = $articleService->getAll("select * from baiviet where ma_tgia = '$ma_tgia'");
        if (isset($_POST['confirm'])) {
            if (count($articles) == 0) {    //nếu không có ràng buộc khóa ngoại với mục bài viết
                $arguments['matacgia'] = $ma_tgia;
                $authorService->delete($arguments);
                header("location:?controller=author");
            } else {
                $list_id = "";
                foreach ($articles as $article) {
                    $list_id = $list_id . $article->getMaBViet() . "; ";
                }
                header("location:?controller=author&action=delete_author&id=$ma_tgia&list_id=$list_id");
            }
        }
        include("views/admin/authors/delete_author.php");
    }
}

?>
<?php
require_once('services/CategoryService.php');
require_once('services/ArticleService.php');

class CategoryController
{
    public function index()
    {
        $categoryService = new CategoryService();
        $categories = $categoryService->getAll('select *from theloai');
        include("views/admin/categories/index.php");
    }

    public function add_category()
    {
        $categoryService = new CategoryService();

        if (isset($_POST['btn'])) {
            $ten_tloai = trim($_POST['ten_tloai']);
            if (!empty($ten_tloai)) {
                $arguments['tentheloai'] = $ten_tloai;
                $categoryService->insert($arguments);
                header("location:?controller=category");
            } else {
                $mess = "Bạn chưa nhập đầy đủ thông tin";
                header("location:?controller=category&action=add_category&mess=$mess");
            }
        }
        include("views/admin/categories/add_category.php");
    }

    public function edit_category()
    {
        $categoryService = new CategoryService();

        //lấy ra thông tin cần sửa
        if (isset($_GET['id']))
            $arguments['matheloai'] = $_GET['id'];
        $category = $categoryService->getById($arguments);

        //nếu nhấn submit thì sẽ tiến hành kiểm tra và sửa thông tin nếu thỏa mãn đk
        if (isset($_POST['btn'])) {
            $ten_tloai = trim($_POST['ten_tloai']);
            $ma_tloai = $_POST['ma_tloai'];
            if (!empty($ten_tloai)) {
                $arguments['tentheloai'] = $ten_tloai;
                $arguments['matheloai'] = $ma_tloai;

                $categoryService->update($arguments);
                header("location:?controller=category");
            } else {
                $mess = "Bạn chưa nhập đầy đủ thông tin";
                header("location:?controller=category&action=edit_category&id=$ma_tloai&mess=$mess");
            }
        }
        include("views/admin/categories/edit_category.php");
    }

    public function delete_category()
    {
        $categoryService = new CategoryService();
        $articleService = new ArticleService();

        $ma_tloai = $_GET['id'];
        $articles = $articleService->getAll("select * from baiviet where ma_tloai = '$ma_tloai'");
        if (isset($_POST['confirm'])) {
            if (count($articles) == 0) {    //nếu không có ràng buộc khóa ngoại với mục bài viết
                $arguments['matheloai'] = $ma_tloai;
                $categoryService->delete($arguments);
                header("location:?controller=category");
            } else {
                $list_id = "";
                foreach ($articles as $article) {
                    $list_id = $list_id . $article->getMaBViet() . "; ";
                }
                header("location:?controller=category&action=delete_category&id=$ma_tloai&list_id=$list_id");
            }
        }
        include("views/admin/categories/delete_category.php");
    }
}

?>
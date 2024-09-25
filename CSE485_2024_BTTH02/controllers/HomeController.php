<?php
require_once('services/ArticleService.php');
require_once('services/CategoryService.php');
require_once('services/AuthorService.php');
require_once('services/UserService.php');

class HomeController
{
    public function index()
    {
        $articleService = new ArticleService();
        $categoryService = new CategoryService();
        include("views/homes/index.php");
    }

    public function login()
    {
        $userService = new UserService();
        session_start();

        if (isset($_POST['btn'])) {
            $user = $_POST["user"];
            $pass = $_POST["pass"];

            $result = $userService->getAll('select * from nguoidung where username ="' . $user . '" and password = "' . $pass . '"');

            if (count($result) > 0) {
                if (isset($_POST['save_pass'])) {
                    setcookie('tennguoidung', $user, time() + 3600, '/', '', 0, 0);
                    setcookie('matkhau', $pass, time() + 3600, '/', '', 0, 0);
                }
                $_SESSION['login'] = $user;
                header("location:?action=admin");
            } else {
                $mess = "tài khoản không tồn tại. Vui lòng kiểm tra lại thông tin đăng nhập";
                header("location:?action=login&notification=" . $mess);
            }
        }
        include("views/homes/login.php");
    }

    public function register()
    {
        $userService = new UserService();

        if (isset($_POST['btn'])) {
            $user = $_POST["user"];
            $pass = $_POST["pass"];

            if (trim($user) != "" and trim($pass) != "") {
                $arguments['user'] = $user;
                $arguments['pass'] = $pass;

                $userService->insert($arguments);
                header("location:?action=login");
            } else {
                $mess = "không được bỏ trống username và password";
                header("location:?action=register&notification=$mess");
            }
        }
        include("views/homes/register.php");
    }

    public function admin()
    {
        $articleService = new ArticleService();
        $categoryService = new CategoryService();
        $authorService = new AuthorService();
        $userService = new UserService();
        session_start();

        if (!isset($_SESSION['login'])) header('location:?action=login');
        $so_luong_baiviet = count($articleService->getAll("select *from baiviet"));
        $so_luong_theloai = count($categoryService->getAll("select *from theloai"));
        $so_luong_tacgia = count($authorService->getAll("select *from tacgia"));
        $so_luong_nguoidung = count($userService->getAll("select *from nguoidung"));

        include("views/admin/index.php");
    }

    public function detail()
    {
        $articleService = new ArticleService();
        $categoryService = new CategoryService();
        $authorService = new AuthorService();

        include("views/homes/detail.php");
    }
}
?>
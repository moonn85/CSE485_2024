<?php
require_once('services/UserService.php');
class UserController
{
    public function index()
    {
        $userService = new UserService();
        include("views/admin/users/index.php");
    }

    public function add_user()
    {
        $userService = new UserService();

        $user = trim($_POST['user'] ?? "");
        $pass = trim($_POST['pass'] ?? "");
        if (isset($_POST['btn'])) {
            if (!empty($user) && !empty($pass)) {
                $arguments['user'] = $user;
                $arguments['pass'] = $pass;

                $userService->insert($arguments);
                header("location:?controller=user");
            } else {
                $mess = "username và password không được bỏ trống";
                header("location:?controller=user&action=add_user&u1=$user&p1=$pass&notification=$mess");
            }
        }
        include("views/admin/users/add_user.php");
    }

    public function edit_user()
    {
        $userService = new UserService();

        $id_user = $_POST['id_user'] ?? "";
        $user = trim($_POST['user'] ?? "");
        $pass = trim($_POST['pass'] ?? "");
        if (isset($_POST['btn'])) {
            if (!empty($user) && !empty($pass)) {
                $arguments['user'] = $user;
                $arguments['pass'] = $pass;
                $arguments['id_user'] = $id_user;

                $userService->update($arguments);
                header("location:?controller=user");
            } else {
                $mess = "username và password không được bỏ trống";
                header("location:?controller=user&action=edit_user&id=$id_user&notification=$mess");
            }
        }

        include("views/admin/users/edit_user.php");
    }

    public function delete_user()
    {
        $userService = new UserService();

        if (isset($_POST['confirm'])) {
            $argument['id_user'] = $_GET['id'];
            $userService->delete($argument);
            header("location:?controller=user");
        }

        include("views/admin/users/delete_user.php");
    }
}

?>
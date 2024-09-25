<?php
$link_css_login = "assets/css/style_login.css";
include("views/layouts/header_home.php");
?>

<main class="container mt-5 mb-5">
    <div class="d-flex justify-content-center h-100">
        <div class="card" style="height: auto;">
            <div class="card-header">
                <h3>register</h3>
                <div class="d-flex justify-content-end social_icon">
                    <span><i class="fab fa-facebook-square"></i></span>
                    <span><i class="fab fa-google-plus-square"></i></span>
                    <span><i class="fa-brands fa-github"></i></span>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="txtUser"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="username" name="user">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="txtPass"><i class="fas fa-key"></i></span>
                        <input type="text" class="form-control" placeholder="password" name="pass">
                    </div>

                    <div class="row" style="color: #ab0000; font-size: 12px; margin:10px;font-style: italic;">
                        <?= $_GET['notification'] ?? "" ?>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="btn" value="register" class="btn float-end login_btn">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center ">
                    Don't have an account?<a href="?action=login" class="text-warning text-decoration-none"> Login</a>
                </div>
            </div>
        </div>

    </div>
</main>

<?php
include("views/layouts/footer.php");
?>
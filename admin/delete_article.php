<?php
                   require 'connection.php';
                   $id = $_GET['id'];
                   $sql = "DELETE FROM baiviet WHERE ma_bviet = $id";
                   $result = mysqli_query($conn, $sql);
                   header("location: article.php");
?>
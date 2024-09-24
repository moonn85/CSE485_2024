<?php
require 'connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM baiviet WHERE ma_tloai = $id";
$result = mysqli_query($conn, $sql);
$sql = "DELETE FROM theloai WHERE ma_tloai = $id";
$result = mysqli_query($conn, $sql);
header("location: category.php");
?>

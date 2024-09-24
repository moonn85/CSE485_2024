<?php
require 'connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM baiviet WHERE ma_tgia = $id";
$result = mysqli_query($conn, $sql);
$sql = "DELETE FROM tacgia WHERE ma_tgia = $id";
$result = mysqli_query($conn, $sql);
header("location: author.php");

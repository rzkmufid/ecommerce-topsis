<?php
session_start();
$koneksi = mysqli_connect('localhost', 'root', '', "db_pkl");

$id = $_GET['id'];

unset($_SESSION["cart"][$id]);
header("location:cart.php");

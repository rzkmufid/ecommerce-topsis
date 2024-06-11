<?php
session_start();
if (!isset($_SESSION["login"]) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header("location:../login");
    exit;
}


$conn = mysqli_connect('localhost', 'root', '', "db_pkl");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM pelanggan WHERE idPelanggan=$id");
    header("Location: list_anggota.php");
}

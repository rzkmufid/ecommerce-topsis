<?php
session_start();
$koneksi = mysqli_connect('localhost', 'root', '', "db_pkl");
$idHp = $_POST['idHp'];
$jumlahhp = $_POST['jumlah'];

$sql = "SELECT * FROM data_hp WHERE id_hp = " . $idHp;
echo $sql;
$query = mysqli_query($koneksi, $sql);

$hasil = mysqli_fetch_object($query);
echo  $hasil->judul;
// echo  $hasil["judul"];

$_SESSION["cart"][$idHp] = [
    "id" => $idHp,
    "nama_hp" => $hasil->nama_hp,
    "harga_hp" => $hasil->harga_hp,
    "ram_hp" => $hasil->ram_hp,
    "memori_hp" => $hasil->memori_hp,
    "processor_hp" => $hasil->processor_hp,
    "image" => $hasil->image,
    "stock" => $hasil->stock,
    "jumlah" => $jumlahhp
];

// $_SESSION['data']['judul'] = $hasil->judul;
// $_SESSION['data']['harga'] = $hasil->harga;

header("location:cart.php");

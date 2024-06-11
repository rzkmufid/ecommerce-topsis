<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', "db_pkl");
if (!isset($_SESSION["login"]) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header("location:../login");
    exit;
}

// Query untuk mengambil data transaksi
$query = "SELECT t.idPayment, p.username, p.nama, hp.nama_hp, hp.harga_hp, dp.jumlah, (hp.harga_hp * dp.jumlah) AS total_harga, t.date
          FROM detailPayment AS dp
          JOIN Payment AS t ON dp.idPayment = t.idPayment
          JOIN pelanggan AS p ON dp.id_pelanggan = p.idPelanggan
          JOIN data_hp AS hp ON dp.id_hp = hp.id_hp;";

$result = mysqli_query($conn, $query);
$query_total = "SELECT SUM(hp.harga_hp * dp.jumlah) AS total_transaksi
                FROM detailPayment AS dp
                JOIN Payment AS t ON dp.idPayment = t.idPayment
                JOIN pelanggan AS p ON dp.id_pelanggan = p.idPelanggan
                JOIN data_hp AS hp ON dp.id_hp = hp.id_hp;";
$result_total = mysqli_query($conn, $query_total);
$row_total = mysqli_fetch_assoc($result_total);
$total_transaksi = $row_total['total_transaksi'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Data Transaksi</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Username Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama HP</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['idPayment'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['nama_hp'] . "</td>";
                    echo "<td>" . $row['jumlah'] . "</td>";
                    echo "<td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="6">Total</td>
                    <td>Rp. <?php echo number_format($total_transaksi, 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
<script>
    window.onload = function() {
        window.print();
    }
</script>

</html>
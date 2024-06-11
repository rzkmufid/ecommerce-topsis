<?php
session_start();
if (!isset($_SESSION["login"]) == true) {
    echo "<script>
                alert('Silahkan Login Terlebih Dahulu');
                document.location.href='./login';
            </script>";
    exit;
}
$koneksi = mysqli_connect('localhost', 'root', '', "db_pkl");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" data-bs-theme="light">
        <div class="container" data-bs-theme="light">
            <a class="navbar-brand" href="./"><img src="assets/svg/logo acumalaka.svg" alt="" /></a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" color="white">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="catalog.php">Catalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="cart.php">Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="spk">Rekomendasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                </ul>
                <div class="hello nav-item dropdown" data-bs-theme="light">
                    <?php

                    if (isset($_SESSION["login"])) {
                        $id = $_SESSION['id'];
                        $resulting = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE idPelanggan ='$id'");
                        $get = mysqli_fetch_array($resulting);
                        echo '<a
                        class="nav-link dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        >';
                        echo '<img src="assets/img/2.jpg" alt="" />';
                        echo ' ' . $get["nama"];
                        echo '</a>';
                    } else {
                        echo '<a href="login" class="btn btn-light">Login</a>';
                        // echo '<>';
                    }
                    ?>


                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <section class="container mt-100">
        <div class="header-cart">
            <h1>Keranjang</h1>
        </div>
        <div class="cart">
            <div class="cart-left">
                <?php
                if (!empty($_SESSION["cart"])) {
                    $grandTotal = 0;



                    foreach ($_SESSION["cart"] as $cart => $val) {
                        $subtotal = $val["harga_hp"] * $val["jumlah"];
                        $grandTotal += $subtotal;
                ?>
                        <div class="cart-list">
                            <img src="assets/img/<?= $val['image'] ?>" alt="" />
                            <div class="detail">
                                <h3><?= $val["nama_hp"] ?></h3>
                                <p><?= $val["jumlah"] ?> pcs</p>
                                <p>Rp. <?= number_format($subtotal) ?></p>
                            </div>
                            <div class="trash">
                                <a href="proccessDeleteCart.php?id=<?= $cart ?>">
                                    <img src="assets/svg/trash.svg" alt="" />
                                </a>
                            </div>
                        </div>
                    <?php

                    }
                    ?>

            </div>
            <div class="cart-right">
                <div class="d-cart">
                    <h3>Rincian Belanja</h3>
                    <p>Total Harga : <span>Rp. <?= number_format($grandTotal); ?></span></p>
                    <a href="proccessTambahTransaksi.php">Bayar</a>
                </div>
            </div>
        </div>
    <?php
                } else {
                    echo "<p style='color:black; margin-top:20px;'>belum ada produk di shopping cart</p>";
                }

    ?>
    </section>

    <footer class="container mt-3">
    </footer>
    <!-- <script src="assets/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', "db_pkl");
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM data_hp WHERE id_hp='$id'");
$dataHp = mysqli_fetch_array($result);
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
        <div class="container" data-bs-theme="dark">
            <a class="navbar-brand" href="./"><img src="assets/svg/logo acumalaka.svg" alt="" /></a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" color="white">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="catalog.php">Catalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                </ul>
                <div class="hello nav-item dropdown">


                    <?php

                    if (isset($_SESSION["login"])) {
                        $id = $_SESSION['id'];
                        $resulting = mysqli_query($conn, "SELECT * FROM pelanggan WHERE idPelanggan ='$id'");
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
                        echo '<a href="login" class="btn btn-dark">Login</a>';
                        // echo '<>';
                    }
                    ?>

                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#">Wishlist</a></li>
                        <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Settings</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <section class="container mt-100">
        <div class="detail">
            <div class="detail-left"><img src="assets/img/<?= $dataHp['image'] ?>" alt=""></div>
            <div class="detail-center">
                <h3><?= $dataHp['nama_hp'] ?></h3>
                <!-- <table>
                    <tr>
                        <td>Ram</td>
                        <td>:</td>
                        <td><?= $dataHp['ram_hp'] ?></td>
                    </tr>
                    <tr>
                        <td>Memori</td>
                        <td>:</td>
                        <td><?= $dataHp['memori_hp'] ?></td>
                    </tr>
                    <tr>
                        <td>Processor</td>
                        <td>:</td>
                        <td><?= $dataHp['processor_hp'] ?></td>
                    </tr>
                </table> -->
                <div class="main-col">
                    <div class="col-details">
                        <p>RAM</p>
                        <p><?= $dataHp['ram_hp'] ?>GB</p>
                    </div>
                    <div class="col-details">
                        <p>Memory</p>
                        <p><?= $dataHp['memori_hp'] ?>GB</p>
                    </div>
                    <div class="col-details">
                        <p>Kamera</p>
                        <p><?= $dataHp['kamera_hp'] ?>MP</p>
                    </div>
                    <div class="col-details">
                        <p>Processor</p>
                        <p><?= $dataHp['processor_hp'] ?></p>
                    </div>
                </div>
                <div class="deskripsi mt-5">
                    <p>Harga</p>
                    <p>Rp. <?= $formatted_uang = number_format($dataHp['harga_hp'], 0, ',', '.'); ?></p>
                </div>
            </div>
            <div class="detail-right">
                <div class="d-keranjang">
                    <h3>Atur jumlah</h3>
                    <div class="qty">
                        <button aria-label="Kurangi 1" tabindex="-1" onclick="kurangSatu()">
                            -
                        </button>
                        <input id="qty-editor-atc" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4565" class="css-197wjuk-unf-quantity-editor__input" data-unify="QuantityEditor" role="spinbutton" type="text" value="1">
                        <button aria-label="Tambah 1" class="css-199ul1b" tabindex="-1" onclick="tambahSatu()">
                            +
                        </button>
                    </div>
                    <form action="proccessAddCart.php" method="POST">
                        <div class="stok">
                            <input type="text" name="idHp" value="<?= $dataHp['id_hp'] ?>" hidden>
                            <input type="text" id="totStok" name="jumlah" hidden>
                            <p>Stok <span id="stok"><?= $dataHp['stock'] ?></span></p>
                        </div>
                        <button class="bKeranjang" name="keranjang">+ Keranjang</button>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <footer class="container mt-3">
    </footer>
    <!-- <script src="assets/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <script>
        total = 1;
        document.getElementById('qty-editor-atc').value = total;
        document.getElementById('totStok').value = total;
        // console.log(total);

        function kurangSatu() {
            total = total - 1;
            if (total < 1) {
                total = 1;
            }
            console.log(total);
            document.getElementById('qty-editor-atc').value = total;
            document.getElementById('totStok').value = total;
        }

        function tambahSatu() {
            total = total + 1;
            if (total > stok) {
                total = stok;
            }
            console.log(total);
            document.getElementById('qty-editor-atc').value = total;
            document.getElementById('totStok').value = total;
        }
        let stok = document.getElementById('stok').innerHTML;
        let textInputElement = document.getElementById("qty-editor-atc");
        textInputElement.addEventListener("keyup", function() {
            listenerTextInputElement = textInputElement.value;
            total = parseInt(listenerTextInputElement);
            document.getElementById('totStok').value = total;

            // console.log('stok is "' + stok + '"');
            // console.log('New text is "' + text + '"');
            if (total < 1) {
                total = 0;
                console.log('New text is "' + total + '"');
                document.getElementById('qty-editor-atc').value = total;
                document.getElementById('totStok').value = total;
            } else if (total > stok) {
                total = stok;
                document.getElementById('qty-editor-atc').value = total;
                document.getElementById('totStok').value = total;

            }
        });

        console.log(kurangSatu());
    </script>
</body>

</html>
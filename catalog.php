<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', "db_pkl");

// Cek apakah form pencarian sudah di-submit
$search_query = '';
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    $result = mysqli_query($conn, "SELECT * FROM data_hp WHERE nama_hp LIKE '%$search_query%'");
} else {
    $result = mysqli_query($conn, "SELECT * FROM data_hp");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-Commerce</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" data-bs-theme="light">
        <div class="container" data-bs-theme="dark">
            <a class="navbar-brand" href="#"><img src="assets/svg/logo acumalaka.svg" alt="" /></a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" color="white">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="catalog.php">Catalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Keranjang</a>
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
        <div class="search-main">
            <form action="" method="get">
                <input type="text" class="search" name="search" placeholder="cari disini" value="<?php echo htmlspecialchars($search_query); ?>" />
                <input type="submit" value="Cari" class="cari" />
            </form>
        </div>
    </section>
    <section class="container recomendasi-section mt-5">
        <h2 class="mt-6">Rekomendasi Smartphone untuk kamu!</h2>
        <div class="rekomendasi mt-3">
            <?php
            while ($user_data = mysqli_fetch_array($result)) {
                echo '<a href="details.php?id=' . $user_data['id_hp'] . '" class="rekomendasi-list">';
                echo '<img src="assets/img/' . $user_data["image"] . '" alt=""  />';
                echo '<h3 class="mt-3">' . $user_data['nama_hp'] . '</h3>';
                echo '<p>Rp.' . number_format($user_data['harga_hp']) . '</p>';
                echo '</a>';
            }
            ?>
        </div>
    </section>
    <footer class="container mt-3">
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
</body>

</html>
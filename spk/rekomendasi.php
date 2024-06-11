<?php
session_start();
if (!isset($_SESSION["login"]) == true) {
	echo "<script>
                alert('Silahkan Login Terlebih Dahulu');
                document.location.href='../login';
            </script>";
	exit;
}
$koneksi = mysqli_connect('localhost', 'root', '', "db_pkl");


?>
<!DOCTYPE html>
<html style="background-color: #efefef">

<head>
	<title>Sistem Pendukung Keputusan Pemilihan Laptop</title>
	<link rel="stylesheet" href="../style.css">
	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="font.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	<nav class="navbar navbar-expand-lg fixed-top" data-bs-theme="light">
		<div class="container" data-bs-theme="dark">
			<a class="navbar-brand" href="./"><img src="../assets/svg/logo acumalaka.svg" alt="" /></a>
			<button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" color="white">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link " aria-current="page" href="../index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../catalog.php">Catalog</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="../cart.php">Keranjang</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="../spk">Rekomendasi</a>
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
						echo '<img src="../assets/img/2.jpg" alt="" />';
						echo ' ' . $get["nama"];
						echo '</a>';
					} else {
						echo '<a href="login" class="btn btn-light">Login</a>';
						// echo '<>';
					}
					?>


					<ul class="dropdown-menu dropdown-menu-light">
						<li>
							<a class="dropdown-item" href="logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<!-- Body Start -->

	<!-- Daftar Laptop Start -->
	<div style="background-color: #efefef">
		<div class="container  mt-5" style="margin-top: 100px">
			<div class="row justify-content-center">
				<div class="col-md-8 mt-5 mb-5">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title text-center">Masukan Bobot</h4>
							<br>
							<form method="POST" action="hasil.php">
								<div class="mb-3 row">
									<label for="harga" class="col-sm-6 col-form-label"><b>Kriteria Harga</b></label>
									<div class="col-sm-6">
										<select class="form-select" id="harga" name="harga" required>
											<option value="" disabled selected>Kriteria Harga</option>
											<option value="5">
												< Rp. 1.000.000</option>
											<option value="4">1.000.000 - 3.000.000</option>
											<option value="3">3.000.000 - 4.000.000</option>
											<option value="2">4.000.000 - 5.000.000</option>
											<option value="1">> 5.000.000</option>
										</select>
									</div>
								</div>

								<div class="mb-3 row">
									<label for="ram" class="col-sm-6 col-form-label"><b>RAM</b></label>
									<div class="col-sm-6">
										<select class="form-select" id="ram" name="ram" required>
											<option value="" disabled selected>Kriteria RAM</option>
											<option value="1">0 - 3 Gb</option>
											<option value="2">4 Gb</option>
											<option value="3">6 Gb</option>
											<option value="4">8 Gb</option>
											<option value="5">> 12 Gb</option>
										</select>
									</div>
								</div>

								<div class="mb-3 row">
									<label for="memori" class="col-sm-6 col-form-label"><b>Memori</b></label>
									<div class="col-sm-6">
										<select class="form-select" id="memori" name="memori" required>
											<option value="" disabled selected>Kriteria Penyimpanan</option>
											<option value="1">0 - 16 GB</option>
											<option value="2">32 GB</option>
											<option value="3">64 GB</option>
											<option value="4">128 GB</option>
											<option value="5">>256 GB</option>
										</select>
									</div>
								</div>

								<div class="mb-3 row">
									<label for="cpu" class="col-sm-6 col-form-label"><b>Processor</b></label>
									<div class="col-sm-6">
										<select class="form-select" id="cpu" name="cpu" required>
											<option value="" disabled selected>Kriteria Processor</option>
											<option value="1">Dualcore</option>
											<option value="3">Quadcore</option>
											<option value="5">Octacore</option>
										</select>
									</div>
								</div>

								<div class="mb-3 row">
									<label for="inches" class="col-sm-6 col-form-label"><b>Kamera</b></label>
									<div class="col-sm-6">
										<select class="form-select" id="inches" name="inches" required>
											<option value="" disabled selected>Kamera</option>
											<option value="1">0 - 32 MP</option>
											<option value="3">32 - 64 MP</option>
											<option value="5">>108 MP</option>
										</select>
									</div>
								</div>

								<div class="text-center">
									<button type="submit" class="btn btn-primary">Hitung</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
<!-- <script src="assets/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
</script>

</html>
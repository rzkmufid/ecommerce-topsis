<?php
session_start();
include('koneksi.php');
if (!isset($_SESSION["login"]) == true) {
	echo "<script>
						alert('Silahkan Login Terlebih Dahulu');
						document.location.href='./login';
				</script>";
	exit;
}
$koneksi = mysqli_connect('localhost', 'root', '', "db_pkl");

//Bobot
$W1	= $_POST['harga'];
$W2	= $_POST['ram'];
$W3	= $_POST['memori'];
$W4	= $_POST['cpu'];
$W5	= $_POST['inches'];

//Pembagi Normalisasi
function pembagiNM($matrik)
{
	for ($i = 0; $i < 5; $i++) {
		$pangkatdua[$i] = 0;
		for ($j = 0; $j < sizeof($matrik); $j++) {
			$pangkatdua[$i] = $pangkatdua[$i] + pow($matrik[$j][$i], 2);
		}
		$pembagi[$i] = sqrt($pangkatdua[$i]);
	}
	return $pembagi;
}

//Normalisasi
function Transpose($squareArray)
{

	if ($squareArray == null) {
		return null;
	}
	$rotatedArray = array();
	$r = 0;

	foreach ($squareArray as $row) {
		$c = 0;
		if (is_array($row)) {
			foreach ($row as $cell) {
				$rotatedArray[$c][$r] = $cell;
				++$c;
			}
		} else $rotatedArray[$c][$r] = $row;
		++$r;
	}
	return $rotatedArray;
}

function JarakIplus($aplus, $bob)
{
	for ($i = 0; $i < sizeof($bob); $i++) {
		$dplus[$i] = 0;
		for ($j = 0; $j < sizeof($aplus); $j++) {
			$dplus[$i] = $dplus[$i] + pow(($aplus[$j] - $bob[$i][$j]), 2);
		}
		$dplus[$i] = round(sqrt($dplus[$i]), 4);
	}
	return $dplus;
}

?>
<!DOCTYPE html>
<html>

<head>

	<title>Sistem Pendukung Keputusan Pemilihan Produk Laptop</title>
	<link rel="stylesheet" href="../style.css">
	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />


	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="font.css">

	<!-- Font Awesome -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> -->
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


					<ul class="dropdown-menu dropdown-menu-dark">
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
		<div class="container">
			<div class="section-card" style="padding: 20px 0px">
				<!--   Icon Section   -->


				<center>
					<h4 class="header" style="margin-left: 24px; margin-bottom: 30px; margin-top: 100px; color: #635c73;">HASIL REKOMENDASI PRODUK LAPTOP</h4>
				</center>
				<ul class="list-unstyled">
					<li>
						<div class="row">
							<div class="card">
								<div class="card-content">
									<h5 style="margin-bottom: 16px; margin-top: 10px;">Matrik Laptop</h5>
									<table class="table table-striped">

										<thead style="border-top: 1px solid #d0d0d0;">
											<tr>
												<th>
													<center>Alternatif</center>
												</th>
												<th>
													<center>C1 (Cost)</center>
												</th>
												<th>
													<center>C2 (Benefit)</center>
												</th>
												<th>
													<center>C3 (Benefit)</center>
												</th>
												<th>
													<center>C4 (Benefit)</center>
												</th>
												<th>
													<center>C5 (Benefit)</center>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = mysqli_query($selectdb, "SELECT * FROM data_hp");
											$no = 1;
											while ($data_hp = mysqli_fetch_array($query)) {
												$Matrik[$no - 1] = array($data_hp['harga_angka'], $data_hp['ram_angka'], $data_hp['memori_angka'], $data_hp['procesor_angka'], $data_hp['kamera_angka']);
											?>
												<tr>
													<td>
														<center><?php echo "A", $no ?></center>
													</td>
													<td>
														<center><?php echo $data_hp['harga_angka'] ?></center>
													</td>
													<td>
														<center><?php echo $data_hp['ram_angka'] ?></center>
													</td>
													<td>
														<center><?php echo $data_hp['memori_angka'] ?></center>
													</td>
													<td>
														<center><?php echo $data_hp['procesor_angka'] ?></center>
													</td>
													<td>
														<center><?php echo $data_hp['kamera_angka'] ?></center>
													</td>
												</tr>
											<?php
												$no++;
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</li>
				</ul>


				<center>
					<h4 class="header" style="margin-left: 24px; margin-bottom: 0px; margin-top: 24px; color: #635c73;">Matriks Ternormalisasi, R:</h4>
				</center>
				<ul class="list-unstyled">
					<li>
						<div class="row">
							<div class="card">
								<div class="card-content">
									<h5 style="margin-bottom: 16px; margin-top: 10px;">Matriks Normalisasi "R"</h5>
									<table class="table table-striped">
								</div>
								<thead style="border-top: 1px solid #d0d0d0;">
									<tr>
										<th>
											<center>Alternatif</center>
										</th>
										<th>
											<center>C1 (Cost)</center>
										</th>
										<th>
											<center>C2 (Benefit)</center>
										</th>
										<th>
											<center>C3 (Benefit)</center>
										</th>
										<th>
											<center>C4 (Benefit)</center>
										</th>
										<th>
											<center>C5 (Benefit)</center>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query = mysqli_query($selectdb, "SELECT * FROM data_hp");
									$no = 1;
									$pembagiNM = pembagiNM($Matrik);
									while ($data_hp = mysqli_fetch_array($query)) {

										$MatrikNormalisasi[$no - 1] = array(
											$data_hp['harga_angka'] / $pembagiNM[0],
											$data_hp['ram_angka'] / $pembagiNM[1],
											$data_hp['memori_angka'] / $pembagiNM[2],
											$data_hp['procesor_angka'] / $pembagiNM[3],
											$data_hp['kamera_angka'] / $pembagiNM[4]
										);

									?>
										<tr>
											<td>
												<center><?php echo "A", $no ?></center>
											</td>
											<td>
												<center><?php echo round($data_hp['harga_angka'] / $pembagiNM[0], 6) ?></center>
											</td>
											<td>
												<center><?php echo round($data_hp['ram_angka'] / $pembagiNM[1], 6) ?></center>
											</td>
											<td>
												<center><?php echo round($data_hp['memori_angka'] / $pembagiNM[2], 6) ?></center>
											</td>
											<td>
												<center><?php echo round($data_hp['procesor_angka'] / $pembagiNM[3], 6) ?></center>
											</td>
											<td>
												<center><?php echo round($data_hp['kamera_angka'] / $pembagiNM[4], 6) ?></center>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
								</tbody>
								</table>
							</div>
						</div>
					</li>
				</ul>


				<center>
					<h4 class="header" style="margin-left: 24px; margin-bottom: 0px; margin-top: 24px; color: #635c73;">BOBOT (W)</h4>
				</center>
				<ul class="list-unstyled">
					<li>
						<div class="row">
							<div class="card">
								<div class="card-content">
									<h5 style="margin-bottom: 16px; margin-top: 10px;">BOBOT (W)</h5>
									<table class="table table-striped">
										<thead>
											<tr>
												<th>
													<center>Value Kriteria Harga</center>
												</th>
												<th>
													<center>Value Kriteria RAM</center>
												</th>
												<th>
													<center>Value Kriteria Memori</center>
												</th>
												<th>
													<center>Value Kriteria CPU</center>
												</th>
												<th>
													<center>Value Kriteria Inches</center>
												</th>
											</tr>
										</thead>
										<tbody>
											<!--count($W)-->
											<tr>
												<td>
													<center><?php echo ($W1); ?></center>
												</td>
												<td>
													<center><?php echo ($W2); ?></center>
												</td>
												<td>
													<center><?php echo ($W3); ?></center>
												</td>
												<td>
													<center><?php echo ($W4); ?></center>
												</td>
												<td>
													<center><?php echo ($W5); ?></center>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</li>
				</ul>


				<center>
					<h4 class="header" style="margin-left: 24px; margin-bottom: 0px; margin-top: 24px; color: #635c73;">Matriks ternormalisasi Terbobot, Y:</h4>
				</center>
				<ul class="list-unstyled">
					<li>
						<div class="row">
							<div class="card">
								<div class="card-content">
									<h5 style="margin-bottom: 16px; margin-top: 10px;">Matriks Normalisasi TerBobot "Y"</h5>
									<table class="table table-striped">

										<thead style="border-top: 1px solid #d0d0d0;">
											<tr>
												<th>
													<center>Alternatif</center>
												</th>
												<th>
													<center>C1 (Cost)</center>
												</th>
												<th>
													<center>C2 (Benefit)</center>
												</th>
												<th>
													<center>C3 (Benefit)</center>
												</th>
												<th>
													<center>C4 (Benefit)</center>
												</th>
												<th>
													<center>C5 (Benefit)</center>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = mysqli_query($selectdb, "SELECT * FROM data_hp");
											$no = 1;
											$pembagiNM = pembagiNM($Matrik);
											while ($data_hp = mysqli_fetch_array($query)) {

												$NormalisasiBobot[$no - 1] = array(
													$MatrikNormalisasi[$no - 1][0] * $W1,
													$MatrikNormalisasi[$no - 1][1] * $W2,
													$MatrikNormalisasi[$no - 1][2] * $W3,
													$MatrikNormalisasi[$no - 1][3] * $W4,
													$MatrikNormalisasi[$no - 1][4] * $W5
												);

											?>
												<tr>
													<td>
														<center><?php echo "A", $no ?></center>
													</td>
													<td>
														<center><?php echo round($MatrikNormalisasi[$no - 1][0] * $W1, 6) ?></center>
													</td>
													<td>
														<center><?php echo round($MatrikNormalisasi[$no - 1][1] * $W2, 6) ?></center>
													</td>
													<td>
														<center><?php echo round($MatrikNormalisasi[$no - 1][2] * $W3, 6) ?></center>
													</td>
													<td>
														<center><?php echo round($MatrikNormalisasi[$no - 1][3] * $W4, 6) ?></center>
													</td>
													<td>
														<center><?php echo round($MatrikNormalisasi[$no - 1][4] * $W5, 6) ?></center>
													</td>
												</tr>
											<?php
												$no++;
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</li>
				</ul>


				<center>
					<h4 class="header" style="margin-left: 24px; margin-bottom: 0px; margin-top: 24px; color: #635c73;">Matrik Solusi Ideal Positif dan Negatif
					</h4>
				</center>
				<ul class="list-unstyled">
					<li>
						<div class="row">
							<div class="card">
								<div class="card-content">
									<h5 style="margin-bottom: 16px; margin-top: 10px;">Matrik Solusi Ideal Positif "A+" dan Negatif "A-"
									</h5>
									<table class="table table-striped">

										<thead style="border-top: 1px solid #d0d0d0;">
											<tr>
												<th>
													<center></center>
												</th>
												<th>
													<center>Y1 (Cost)</center>
												</th>
												<th>
													<center>Y2 (Benefit)</center>
												</th>
												<th>
													<center>Y3 (Benefit)</center>
												</th>
												<th>
													<center>Y4 (Benefit)</center>
												</th>
												<th>
													<center>Y5 (Benefit)</center>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$NormalisasiBobotTrans = Transpose($NormalisasiBobot);
											?>
											<tr>
												<?php
												$idealpositif = array(min($NormalisasiBobotTrans[0]), max($NormalisasiBobotTrans[1]), max($NormalisasiBobotTrans[2]), max($NormalisasiBobotTrans[3]), max($NormalisasiBobotTrans[4]));
												?>
												<td>
													<center><?php echo "Y+" ?> </center>
												</td>
												<td>
													<center><?php echo (round(min($NormalisasiBobotTrans[0]), 6)); ?>&nbsp(min)</center>
												</td>
												<td>
													<center><?php echo (round(max($NormalisasiBobotTrans[1]), 6)); ?>&nbsp(max)</center>
												</td>
												<td>
													<center><?php echo (round(max($NormalisasiBobotTrans[2]), 6)); ?>&nbsp(max)</center>
												</td>
												<td>
													<center><?php echo (round(max($NormalisasiBobotTrans[3]), 6)); ?>&nbsp(max)</center>
												</td>
												<td>
													<center><?php echo (round(max($NormalisasiBobotTrans[4]), 6)); ?>&nbsp(max)</center>
												</td>
											</tr>
											<tr>
												<?php
												$idealnegatif = array(max($NormalisasiBobotTrans[0]), min($NormalisasiBobotTrans[1]), min($NormalisasiBobotTrans[2]), min($NormalisasiBobotTrans[3]), min($NormalisasiBobotTrans[4]));
												?>
												<td>
													<center><?php echo "Y-" ?> </center>
												</td>
												<td>
													<center><?php echo (round(max($NormalisasiBobotTrans[0]), 6)); ?>&nbsp(max)</center>
												</td>
												<td>
													<center><?php echo (round(min($NormalisasiBobotTrans[1]), 6)); ?>&nbsp(min)</center>
												</td>
												<td>
													<center><?php echo (round(min($NormalisasiBobotTrans[2]), 6)); ?>&nbsp(min)</center>
												</td>
												<td>
													<center><?php echo (round(min($NormalisasiBobotTrans[3]), 6)); ?>&nbsp(min)</center>
												</td>
												<td>
													<center><?php echo (round(min($NormalisasiBobotTrans[4]), 6)); ?>&nbsp(min)</center>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</li>
				</ul>


				<center>
					<h4 class="header" style="margin-left: 24px; margin-bottom: 0px; margin-top: 24px; color: #635c73;">Jarak antara nilai terbobot setiap alternatif terhadap solusi ideal positif
					</h4>
				</center>
				<ul class="list-unstyled">
					<li>
						<div class="row">
							<div class="card" style="margin-right: 320px;">
								<div class="card-content">
									<table class="table table-striped">
										<thead style="border-top: 1px solid #d0d0d0;">
											<tr>
												<th>
													<center>D+</center>
												</th>
												<th>
													<center></center>
												</th>
												<th>
													<center>D-</center>
												</th>
												<th>
													<center></center>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = mysqli_query($selectdb, "SELECT * FROM data_hp");
											$no = 1;
											$Dplus = JarakIplus($idealpositif, $NormalisasiBobot);
											$Dmin = JarakIplus($idealnegatif, $NormalisasiBobot);
											while ($data_hp = mysqli_fetch_array($query)) {

											?>
												<tr>
													<td>
														<center><?php echo "D", $no ?></center>
													</td>
													<td>
														<center><?php echo round($Dplus[$no - 1], 6) ?></center>
													</td>
													<td>
														<center><?php echo "D", $no ?></center>
													</td>
													<td>
														<center><?php echo round($Dmin[$no - 1], 6) ?></center>
													</td>
												</tr>
											<?php
												$no++;
											}
											?>
										</tbody>
									</table>

								</div>
							</div>
						</div>
					</li>
				</ul>


				<center>
					<h4 class="header" style=" margin-bottom: 0px; margin-top: 24px; color: #635c73;">Nilai Preferensi Untuk Setiap alternatif (V)
					</h4>
				</center>
				<ul class="list-unstyled">
					<li>
						<div class="row">
							<div class="card" style="margin-right: 320px;">
								<div class="card-content">
									<table class="table table-striped">

										<thead style="border-top: 1px solid #d0d0d0;">
											<tr>
												<th>
													<center>Nilai Preferensi "V"</center>
												</th>
												<th>
													<center>Nilai</center>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = mysqli_query($selectdb, "SELECT * FROM data_hp");
											$no = 1;
											$nilaiV = array();
											while ($data_hp = mysqli_fetch_array($query)) {

												array_push($nilaiV, $Dmin[$no - 1] / ($Dmin[$no - 1] + $Dplus[$no - 1]));
											?>
												<tr>
													<td>
														<center><?php echo "V", $no ?></center>
													</td>
													<td>
														<center><?php echo $Dmin[$no - 1] / ($Dmin[$no - 1] + $Dplus[$no - 1]); ?></center>
													</td>
												</tr>
											<?php
												$no++;
											}

											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</li>
				</ul>


				<center>
					<h4 class="header" style="margin-left: 24px; margin-bottom: 0px; margin-top: 24px; color: #635c73;">Nilai Preferensi tertinggi
					</h4>
				</center>
				<ul class="list-unstyled">
					<li>
						<div class="row">
							<div class="card" style="margin-right: 300px;">
								<div class="card-content">

									<table class="table table-striped">
										<thead style="border-top: 1px solid #d0d0d0;">
											<tr>
												<th>
													<center>Nilai Preferensi Tertinggi</center>
												</th>
												<th></th>
												<th>
													<center>Alternatif HP Terpilih</center>
												</th>
												<th>
													<center>Action</center>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$testmax = max($nilaiV);
											for ($i = 0; $i < count($nilaiV); $i++) {
												if ($nilaiV[$i] == $testmax) {
													$query = mysqli_query($selectdb, "SELECT * FROM data_hp WHERE id_hp = " . ($i + 1));
													echo '<tr>';
													echo '<td><center>' . "V" . ($i + 1) . '</center></td>';
													echo '<td><center>' . $nilaiV[$i] . '</center></td>';
													while ($user = mysqli_fetch_array($query)) {
														// echo '<td><center>' . $user['nama_hp'] . '</center></td>';
														echo '<td><center><a href="../details.php?id=' . $user["id_hp"] . '">';
														echo $user["nama_hp"] . '</a></center></td>';
														echo '<td>
																<center><a class="btn btn-primary" href="../details.php?id=
																	' . $user["id_hp"] . '">Lihat Hp</a>
																</center>
															</td>';
													}
													echo '</tr>';
												}
											}
											?>

										</tbody>
									</table>
									<!-- <a href="details.php?id='.$user['id_hp']'"></a> -->
								</div>
							</div>
						</div>
					</li>
				</ul>
				<div class="row center" \>
					<a href="rekomendasi.php" id="download-button" class="btn btn-primary" style="margin-top: 0px">Hitung Ulang Rekomendasi </a>
				</div>
			</div>
		</div>
	</div>
	<!-- Daftar Laptop End -->
	<!-- Modal Start -->
	<div id="about" class="modal">
		<div class="modal-content">
			<h4>Tentang</h4>
			<p>Sistem Pendukung Keputusan Pemilihan Produk Laptop Ini Menggunakan Metode TOPSIS.</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
		</div>
	</div>
	<!-- Modal End -->

	<!-- Body End -->

	<!-- Footer Start -->
	<div class="footer-copyright" style="padding: 0px 0px; background-color: white">
		<div class="container">
			<p align="center" style="color: #999">&copy; Sistem Pendukung Keputusan Pemilihan Produk Laptop.(2022).</p>
		</div>
	</div>
	<!-- Footer End -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('.parallax').parallax();
			$('.modal').modal();
		});
	</script>
</body>

</html>
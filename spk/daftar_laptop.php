<?php
session_start();
include('koneksi.php');
?>

<?php
	if(isset($_POST["tambah_hp"])){
		$produks    = $_POST["produks"];
		$hargas	   = $_POST["hargas"];
		$rams       = $_POST["rams"];
		$memorys    = $_POST["memorys"];
		$cpus 	   = $_POST["processors"];
		$cameras    = $_POST["kameras"];

		$harga_angka = $ram_angka = $memory_angka = $cpu_angka = $inches_angka = 0;

		if($hargas > 5000000){
			$harga_angka = 5;
		}
		elseif($hargas >= 4000000 && $hargas <= 5000000){
			$harga_angka = 4;
		}
		elseif($hargas >= 3000000 && $hargas <= 4000000){
			$harga_angka = 3;
		}
		elseif($hargas >= 1000000 && $hargas <= 3000000){
			$harga_angka = 2;
		}
		elseif($hargas < 3000000){
			$harga_angka = 1;
		}


		if((int)$rams >= 12){
			$ram_angka = 5;
		}
		elseif((int)$rams == 8){
			$ram_angka = 4;
		}
		elseif((int)$rams == 6){
			$ram_angka = 3;
		}
		elseif((int)$rams == 4){
			$ram_angka = 2;
		}
		elseif((int)$rams <= 3){
			$ram_angka = 1;
		}


		if((int)$memorys >= 256){
			$memory_angka = 5;
		}
		elseif((int)$memorys == 128){
			$memory_angka = 4;
		}
		elseif((int)$memorys == 64){
			$memory_angka = 3;
		}
		elseif((int)$memorys == 32){
			$memory_angka = 2;
		}
		elseif((int)$memorys <= 16){
			$memory_angka = 1;
		}


		if($cpus == "Dualcore"){
			$cpu_angka = 1;
		}
		elseif($cpus == "Quadcore"){
			$cpu_angka = 3;
		}
		elseif($cpus == "Octacore"){
			$cpu_angka = 5;
		}


		if($cameras >= 64){
			$inches_angka = 5;
		}
		elseif($cameras >= 32 && $cameras <= 64){
			$inches_angka = 3;
		}
		elseif($cameras < 32){
			$inches_angka = 1;
		}

		$sql = "INSERT INTO `data_hp` (`id_hp`,`nama_hp`, `harga_hp`, `ram_hp`, `memori_hp`, `processor_hp`, `kamera_hp`, `harga_angka`, `ram_angka`, `memori_angka`, `procesor_angka`, `kamera_angka`)
				VALUES (NULL,:nama_hp, :harga_hp, :ram_hp, :memori_hp, :processor_hp, :kamera_hp, :harga_angka, :ram_angka, :memori_angka, :procesor_angka, :kamera_angka)";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':nama_hp', $produks);
		$stmt->bindValue(':harga_hp', $hargas);
		$stmt->bindValue(':ram_hp', $rams);
		$stmt->bindValue(':memori_hp', $memorys);
		$stmt->bindValue(':processor_hp', $cpus);
		$stmt->bindValue(':kamera_hp', $cameras);
		$stmt->bindValue(':harga_angka', $harga_angka);
		$stmt->bindValue(':ram_angka', $ram_angka);
		$stmt->bindValue(':memori_angka', $memory_angka);
		$stmt->bindValue(':procesor_angka', $cpu_angka);
		$stmt->bindValue(':kamera_angka', $inches_angka);
		$stmt->execute();
	}

	if(isset($_POST["hapus_laptop"])){
		$id_hapus_laptop = $_POST['id_hapus_laptop'];
		$sql_delete = "DELETE FROM `data_laptop` WHERE `id` = :id_hapus_laptop";
		$stmt_delete = $db->prepare($sql_delete);
		$stmt_delete->bindValue(':id_hapus_laptop', $id_hapus_laptop);
		$stmt_delete->execute();
		$query_reorder_id=mysqli_query($selectdb,"ALTER TABLE data_laptop AUTO_INCREMENT = 1");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistem Pendukung Keputusan Pemilihan Laptop</title>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
	<link rel="stylesheet" href="assets/css/table.css">
	<link rel="stylesheet" href="assets/css/style.css">

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!--Import jQuery before materialize.js-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/materialize.js"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

	<!-- Data Table -->
	<link rel="stylesheet" type="text/css" href="assets/dataTable/jquery.dataTables.min.css">
	<script type="text/javascript" charset="utf8" src="assets/dataTable/jquery.dataTables.min.js"></script>

</head>
<body>
	<div class="navbar-fixed">
	<nav>
    	<div class="container">

						<div class="nav-wrapper">
								<ul class="left" style="margin-left: -52px;">
									<li><a href="../index.php">HOME</a></li>
									<li><a href="rekomendasi.php">REKOMENDASI</a></li>
									<li><a class="active" href="daftar_laptop.php">DAFTAR LAPTOP</a></li>
									<li><a href="#about">TENTANG</a></li>
								</ul>
						</div>

        </div>
		</nav>
		</div>
		<!-- Body Start -->

		<!-- Daftar laptop Start -->
	<div style="background-color: #efefef">
		<div class="container">
		    <div class="section-card" style="padding: 40px 0px 20px 0px;">
				<ul>
				    <li>
						<div class="row">
						<div class="card">
								<div class="card-content">
									<center><h4 style="margin-bottom: 0px; margin-top: -8px;">Daftar HP</h4></center>
									<table id="table_id" class="hover dataTablesCustom" style="width:100%">
											<thead style="border-top: 1px solid #d0d0d0;">
												<tr>
													<th><center>No </center></th>
													<th><center>Nama HP</center></th>
													<th><center>Harga HP</center></th>
													<th><center>RAM HP</center></th>
													<th><center>Memori HP</center></th>
													<th><center>Processor HP</center></th>
													<th><center>Kamera HP</center></th>
													<th><center>Hapus</center></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$query=mysqli_query($selectdb,"SELECT * FROM data_hp");
												$no=1;
												while ($data=mysqli_fetch_array($query)) {
												?>
												<tr>
													<td><center><?php echo $no; ?></center></td>
													<td><center><?php echo $data['nama_hp']?></center></td>
													<td><center><?php echo "Rp. ", $data['harga_hp'] ?></center></td>
													<td><center><?php echo $data['ram_hp']," GB" ?></center></td>
													<td><center><?php echo $data['memori_hp'] ?></center></td>
													<td><center><?php echo $data['processor_hp'] ?></center></td>
													<td><center><?php echo $data['kamera_hp']," MP" ?></center></td>
													<td>
														<center>
															<form method="POST">
																<input type="hidden" name="id_hapus_laptop" value="<?php echo $data['id_hp']?>">
																<button type="submit" name="hapus_laptop" style="height: 32px; width: 32px;" class="btn-floating btn-small waves-effect waves-light red"><i style="line-height: 32px;" class="material-icons">remove</i></button>
															</form>
														</center>
													</td>
												</tr>
												<?php
														$no++;}
												?>
											</tbody>
									</table>
									</div>

							</div>
							<a href="#tambah" class="btn-floating btn-large waves-effect waves-light teal btn-float-custom"><i class="material-icons">add</i></a>
						</div>
				    </li>
				</ul>
	    	</div>
		</div>
	</div>
	<!-- Daftar laptop End -->

	<!-- Daftar laptop Start -->
	<div style="background-color: #efefef">
		<div class="container">
		    <div class="section-card" style="padding: 1px 20% 24px 20%;">
				<ul>
				    <li>
						<div class="row">
							<div class="card">
								<div class="card-content" style="padding-top: 10px;">
									<center><h5 style="margin-bottom: 10px;">Analisa HP</h5></center>
									<table class="responsive-table">

											<thead style="border-top: 1px solid #d0d0d0;">
												<tr>
													<th><center>Alternatif</center></th>
													<th><center>C1 (Cost)</center></th>
													<th><center>C2 (Benefit)</center></th>
													<th><center>C3 (Benefit)</center></th>
													<th><center>C4 (Benefit)</center></th>
													<th><center>C5 (Benefit)</center></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$query=mysqli_query($selectdb,"SELECT * FROM data_hp");
												$no=1;
												while ($data=mysqli_fetch_array($query)) {
												?>
												<tr>
													<td><center><?php echo "A",$no ?></center></td>
													<td><center><?php echo $data['harga_angka'] ?></center></td>
													<td><center><?php echo $data['ram_angka'] ?></center></td>
													<td><center><?php echo $data['memori_angka'] ?></center></td>
													<td><center><?php echo $data['procesor_angka'] ?></center></td>
													<td><center><?php echo $data['kamera_angka'] ?></center></td>
												</tr>
												<?php
														$no++;}
												?>
											</tbody>
									</table>
									</div>
							</div>
						</div>
				    </li>
				</ul>
	    	</div>
		</div>
	</div>
	<!-- Daftar laptop End -->

	<!-- Modal Start -->
	<div id="tambah" class="modal" style="width: 40%; height: 100%;">
		<div class="modal-content">
			<div class="col s6">
					<div class="card-content">
						<div class="row">
							<center><h5 style="margin-top:-8px;">Masukan HP</h5></center>
							<form method="POST" action="">
								<div class = "row">
									<div class="col s12">
										<div class="col s6" style="margin-top: 10px;">
											<b>Nama HP</b>
										</div>
										<div class="col s6">
											<input style="height: 2rem;" name="produks" type="text" required>
										</div>

										<div class="col s6" style="margin-top: 10px;">
											<b>Harga</b>
										</div>
										<div class="col s6">
											<input style="height: 2rem;" name="hargas" type="number" required>
										</div>

										<div class="col s6" style="margin-top: 10px;">
										<b>RAM</b>
										</div>
										<div class="col s6">
											<select style="display: block; margin-bottom: 4px;" required name="rams">
												<!-- <option value = "" disabled selected>Kriteria RAM</option>  -->
												<option value = "2">2 Gb</option>
												<option value = "3">3 Gb</option>
												<option value = "4">4 Gb</option>
												<option value = "6">6 Gb</option>
												<option value = "8">8 Gb</option>
												<option value = "12"> 12 Gb</option>
												<option value = "16"> 16 Gb</option>
												<option value = "32"> 32 Gb</option>
												<option value = "64"> 64 Gb</option>
											</select>
										</div>

										<div class="col s6" style="margin-top: 10px;">
											<b>Memori</b>
										</div>
										<div class="col s6">
											<select style="display: block; margin-bottom: 4px;" required name="memorys">
												<!-- <option value = "" disabled selected>Kriteria Penyimpanan</option> -->
												<option value = "16">16 GB</option>
												<option value = "32">32 GB</option>
												<option value = "64">64 GB</option>
												<option value = "128">128 GB</option>
												<option value = "256">256 GB</option>
												<option value = "512">512 GB</option>
												<option value = "1024">1 TB</option>
											</select>
										</div>

										<div class="col s6" style="margin-top: 10px;">
											<b>Processor</b>
										</div>
										<div class="col s6">
											<select style="display: block; margin-bottom: 4px;" required name="processors">
												<option value = "Dualcore">Dualcore</option>
												<option value = "Quadcore">Quadcore</option>
												<option value = "Octacore">Octacore</option>
											</select>
										</div>

										<div class="col s6" style="margin-top: 10px;">
											<b>Kamera</b>
										</div>
										<div class="col s6">
											<input style="height: 2rem;" name="kameras" type="number" required>
										</div>

									</div>
								</div>
								<center><button name="tambah_hp" type="submit" class="waves-effect waves-light btn teal" style="margin-top: 0px;">Tambah</button></center>
							</form>
						</div>
					</div>
				</div>
			</div>
		<div style="height: 0px; "class="modal-footer">
          <a style="margin-top: -30px;" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
        </div>
	</div>
	<!-- Modal End -->

	<!-- Modal Start -->
	<div id="about" class="modal">
		<div class="modal-content">
			<h4>Tentang</h4>
			<p>Sistem Pendukung Keputusan Pemilihan Laptop ini menggunakan metode TOPSIS.</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div>
	<!-- Modal End -->

    <!-- Body End -->

    <!-- Footer Start -->
	<div class="footer-copyright" style="padding: 0px 0px; background-color: white">
      <div class="container">
        <p align="center" style="color: #999">&copy; Sistem Pendukung Keputusan Pemilihan Laptop 2022.</p>
      </div>
    </div>
    <!-- Footer End -->
    <script type="text/javascript">
	  	$(document).ready(function(){
		$('.parallax').parallax();
		$('.modal').modal();
		$('#table_id').DataTable({
    		"paging": false
		});
	    });
	</script>
</body>
</html>

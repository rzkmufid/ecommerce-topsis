<?php
session_start();
if (!isset($_SESSION["login"]) == true) {
    header("location:../login");
    exit;
} else if ($_SESSION['level'] == 'user') {
    header("location:../");
    exit;
}
$db = mysqli_connect('localhost', 'root', '', 'db_pkl');

// session_start();
if (!isset($_SESSION["login"]) == true) {
    header("location:../login");
    exit;
} else if ($_SESSION['level'] == 'user') {
    header("location:../");
    exit;
}

?>
<?php
if (isset($_POST["tambah_hp"])) {
    $produks    = $_POST["produks"];
    $hargas     = $_POST["hargas"];
    $rams       = $_POST["rams"];
    $memorys    = $_POST["memorys"];
    $cpus      = $_POST["processors"];
    $cameras    = $_POST["kameras"];
    $stocks    = $_POST["stoks"];

    if (isset($_FILES['fotoHP'])) {
        $filename = $_FILES['fotoHP']['name'];
        $filetmpname = $_FILES['fotoHP']['tmp_name'];
        $folder = '../assets/img/';
        move_uploaded_file($filetmpname, $folder . $filename);
    }


    $harga_angka = $ram_angka = $memory_angka = $cpu_angka = $camera_angka = 0;



    if ($hargas > 5000000) {
        $harga_angka = 5;
    } elseif ($hargas >= 4000000 && $hargas <= 5000000) {
        $harga_angka = 4;
    } elseif ($hargas >= 3000000 && $hargas <= 4000000) {
        $harga_angka = 3;
    } elseif ($hargas >= 1000000 && $hargas <= 3000000) {
        $harga_angka = 2;
    } elseif ($hargas < 3000000) {
        $harga_angka = 1;
    }


    if ((int)$rams >= 12) {
        $ram_angka = 5;
    } elseif ((int)$rams == 8) {
        $ram_angka = 4;
    } elseif ((int)$rams == 6) {
        $ram_angka = 3;
    } elseif ((int)$rams == 4) {
        $ram_angka = 2;
    } elseif ((int)$rams <= 3) {
        $ram_angka = 1;
    }


    if ((int)$memorys >= 256) {
        $memory_angka = 5;
    } elseif ((int)$memorys == 128) {
        $memory_angka = 4;
    } elseif ((int)$memorys == 64) {
        $memory_angka = 3;
    } elseif ((int)$memorys == 32) {
        $memory_angka = 2;
    } elseif ((int)$memorys <= 16) {
        $memory_angka = 1;
    }


    if ($cpus == "Dualcore") {
        $cpu_angka = 1;
    } elseif ($cpus == "Quadcore") {
        $cpu_angka = 3;
    } elseif ($cpus == "Octacore") {
        $cpu_angka = 5;
    }


    if ($cameras >= 64) {
        $camera_angka = 5;
    } elseif ($cameras >= 32 && $cameras <= 64) {
        $camera_angka = 3;
    } elseif ($cameras < 32) {
        $camera_angka = 1;
    }

    $sql = "INSERT INTO `data_hp` (`id_hp`, `nama_hp`, `harga_hp`, `ram_hp`, `memori_hp`, `processor_hp`, `kamera_hp`, `harga_angka`, `ram_angka`, `memori_angka`, `procesor_angka`, `kamera_angka`, `image`, `stock`)
	        VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('sssssssssssss', $produks, $hargas, $rams, $memorys, $cpus, $cameras, $harga_angka, $ram_angka, $memory_angka, $cpu_angka, $camera_angka, $filename, $stocks);
    $stmt->execute();
}
//
// if(isset($_POST["hapus_laptop"])){
// 	$id_hapus_laptop = $_POST['id_hapus_laptop'];
// 	$sql_delete = "DELETE FROM `data_laptop` WHERE `id` = :id_hapus_laptop";
// 	$stmt_delete = $db->prepare($sql_delete);
// 	$stmt_delete->bindValue(':id_hapus_laptop', $id_hapus_laptop);
// 	$stmt_delete->execute();
// 	$query_reorder_id=mysqli_query($selectdb,"ALTER TABLE data_laptop AUTO_INCREMENT = 1");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Jaya Ponsel |Tambah Produk </title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- Theme style -->

    <link rel="stylesheet" href="https://kit.fontawesome.com/be8f875c1c.css" crossorigin="anonymous">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- <link rel="stylesheet" href="../style.css"> -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

</head>

<body>
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/Logo.png" alt="Logo" height="60" width="60">
  </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="../assets/img/2.jpg" style="width: 30px;" alt="User Avatar" class="mr-2 img-circle">
                        <?php echo $_SESSION['level']; ?>
                        <!-- <i class="far fa-user"></i> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="../logout.php" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Logout
                                        <!-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> -->
                                    </h3>
                                    <p class="text-sm">Keluar dari Akun</p>
                                    <!-- <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p> -->
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>

                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->

                <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../assets/img/2.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['level']; ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="./" class="nav-link ">
                                <i class="nav-icon fas fa-tachometer"></i>
                                <p>
                                    Dashboard

                                </p>
                            </a>
                        </li>
                        <!-- anggota menu -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Anggota
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="list_anggota.php" class="nav-link">
                                        <i class="nav-icon fa fa-book"></i>
                                        <p>List Anggota</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="list_admin.php" class="nav-link">
                                        <i class="nav-icon fa fa-book"></i>
                                        <p>List Admin</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="daftar.php" class="nav-link">
                                        <i class="nav-icon fas fa-add"></i>
                                        <p>
                                            Tambah Admin
                                            <!-- <span class="right badge badge-danger">New</span> -->
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!-- ////asdasdasdasd// -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Management HP
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="hp.php" class="nav-link ">
                                        <i class="nav-icon fa fa-book"></i>
                                        <p>Catalog HP</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="tambah.php" class="nav-link active">
                                        <i class="nav-icon fas fa-add"></i>
                                        <p>
                                            Tambah Catalog HP
                                            <!-- <span class="right badge badge-danger">New</span> -->
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="transaksi.php" class="nav-link">
                                        <i class="nav-icon fas fa-print"></i>
                                        <p>
                                            Laporan
                                            <!-- <span class="right badge badge-danger">New</span> -->
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tambah Catalog HP</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home Admin</a></li>
                                <li class="breadcrumb-item active">Tambah Catalog HP</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


            <div class="container-fluid">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col s12">
                            <div class="col s6  form-group">
                                <label for="produks"><b>Nama HP</b></label>
                                <input class="form-control" class="form-control" class="form-control"
                                    style="height: 2rem;" name="produks" type="text" required>
                            </div>

                            <div class="col s6 form-group form-group">
                                <label for="hargas"><b>Harga</b></label>
                                <input class="form-control" class="form-control" class="form-control"
                                    style="height: 2rem;" name="hargas" type="number" required>
                            </div>

                            <div class="col s6 form-group form-group">
                                <label for="rams"><b>RAM</b></label>
                                <select class="form-control" style="display: block; margin-bottom: 4px;" required
                                    name="rams">
                                    <!-- <option value = "" disabled selected>Kriteria RAM</option>  -->
                                    <option value="2">2 Gb</option>
                                    <option value="3">3 Gb</option>
                                    <option value="4">4 Gb</option>
                                    <option value="6">6 Gb</option>
                                    <option value="8">8 Gb</option>
                                    <option value="12"> 12 Gb</option>
                                    <option value="16"> 16 Gb</option>
                                    <option value="32"> 32 Gb</option>
                                    <option value="64"> 64 Gb</option>
                                </select>
                            </div>

                            <div class="col s6 form-group form-group">
                                <label for="memorys"><b>Memori</b></label>
                                <select class="form-control" style="display: block; margin-bottom: 4px;" required
                                    name="memorys">
                                    <!-- <option value = "" disabled selected>Kriteria Penyimpanan</option> -->
                                    <option value="16">16 GB</option>
                                    <option value="32">32 GB</option>
                                    <option value="64">64 GB</option>
                                    <option value="128">128 GB</option>
                                    <option value="256">256 GB</option>
                                    <option value="512">512 GB</option>
                                    <option value="1024">1 TB</option>
                                </select>
                            </div>

                            <div class="col s6 form-group form-group">
                                <label for="processors"><b>Processor</b></label>
                                <select class="form-control" style="display: block; margin-bottom: 4px;" required
                                    name="processors">
                                    <option value="Dualcore">Dualcore</option>
                                    <option value="Quadcore">Quadcore</option>
                                    <option value="Octacore">Octacore</option>
                                </select>
                            </div>

                            <div class="col s6 form-group">
                                <label for="kameras"><b>Kamera</b></label>
                                <input class="form-control" class="form-control" class="form-control"
                                    style="height: 2rem;" name="kameras" type="number" required>
                            </div>

                            <div class="form-group col s6 form-group form-group">
                                <label for="stoks"><b>Stok</b></label>
                                <input class="form-control" class="form-control" class="form-control"
                                    style="height: 2rem;" name="stoks" type="number" required>
                            </div>

                            <div class="form-group col s6">
                                <label for="fotoHP">Foto HP</label>
                                <input type="file" class="form-control-file" name="fotoHP">
                            </div>


                        </div>
                    </div>
                    <center><button name="tambah_hp" type="submit" class="btn btn-primary mt-3">Tambah</button></center>
                </form>
            </div>

            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://.io">.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>


    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!--  App -->
    <script src="dist/js/.js"></script>
    <!--  for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    <!--  dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="https://kit.fontawesome.com/be8f875c1c.js" crossorigin="anonymous"></script>
</body>

</html>
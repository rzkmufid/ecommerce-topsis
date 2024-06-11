<?php
session_start();

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', "db_pkl");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in and has the right level
if (!isset($_SESSION["login"]) || $_SESSION['level'] != 'admin') {
  header("Location: ../login");
  exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM data_hp WHERE id_hp='$id'");

if (isset($_POST["Edit"])) {
  $nama_hp = $_POST["nama_hp"];
  $harga_hp = $_POST["harga_hp"];
  $ram_hp = $_POST["rams"];
  $memori_hp = $_POST["memorys"];
  $processor_hp = $_POST["processors"];
  $kamera_hp = $_POST["kameras"];
  $stok = $_POST["stoks"];
  $filename = $_FILES['gambarHp']['name'];

  // File upload handling
  if ($filename) {
    $filetmpname = $_FILES['gambarHp']['tmp_name'];
    $folder = '../assets/img/';
    move_uploaded_file($filetmpname, $folder . $filename);
  } else {
    $filename = $_POST["current_image"];
  }

  // Prepared statement to update data
  $stmt = $conn->prepare("UPDATE data_hp SET nama_hp = ?, harga_hp = ?, ram_hp = ?, memori_hp = ?, processor_hp = ?, kamera_hp = ?, stock = ?, image = ? WHERE id_hp = ?");
  $stmt->bind_param("ssiissisi", $nama_hp, $harga_hp, $ram_hp, $memori_hp, $processor_hp, $kamera_hp, $stok, $filename, $id);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    echo "<script>
            alert('Data Berhasil Disimpan');
            document.location.href='hp.php';
        </script>";
  } else {
    echo "<script>
            alert('Data Gagal Disimpan');
        </script>";
  }
  $stmt->close();
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Jaya Ponsel | Edit Produk</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
  <!-- Theme style -->

  <link rel="stylesheet" href="https://kit.fontawesome.com/be8f875c1c.css" crossorigin="anonymous">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- <link rel="stylesheet" href="../style.css"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="./" class="nav-link">
                <i class="nav-icon fas fa-tachometer"></i>
                <p>
                  Dashboard
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="daftar.php" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Tambah Pengguna
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-database"></i>
                <p>
                  Management Buku
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="buku.php" class="nav-link active">
                    <i class="nav-icon fa fa-book"></i>
                    <p>
                      Catalog Buku
                      <!-- <span class="right badge badge-danger">New</span> -->
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="tambah.php" class="nav-link">
                    <i class="nav-icon fas fa-add"></i>
                    <p>
                      Tambah Catalog Buku
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
              <h1 class="m-0">Edit Buku</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home Admin</a></li>
                <li class="breadcrumb-item active">Edit Buku</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="container-fluid">
          <form action="" method="post" enctype="multipart/form-data">
            <table class="container-fluid">
              <tr>
                <td><label for="nama_hp">Nama HP</label> </td>
                <td><input class="form-control" type="text" name="nama_hp" value="<?php echo $row["nama_hp"]; ?>"></td>
              </tr>
              <tr>
                <td><label for="harga_hp">Harga HP</label> </td>
                <td><input class="form-control" type="text" name="harga_hp" value="<?php echo $row["harga_hp"]; ?>"></td>
              </tr>
              <tr>
                <td><label for="rams"><b>RAM</b></label></td>
                <td>
                  <select class="form-control" style="display: block; margin-bottom: 4px;" required name="rams">
                    <!-- <option value = "" disabled selected>Kriteria RAM</option>  -->
                    <option value="2" <?php echo $row["ram_hp"] == 2 ? 'selected' : ''; ?>>2 Gb</option>
                    <option value="3" <?php echo $row["ram_hp"] == 3 ? 'selected' : ''; ?>>3 Gb</option>
                    <option value="4" <?php echo $row["ram_hp"] == 4 ? 'selected' : ''; ?>>4 Gb</option>
                    <option value="6" <?php echo $row["ram_hp"] == 6 ? 'selected' : ''; ?>>6 Gb</option>
                    <option value="8" <?php echo $row["ram_hp"] == 8 ? 'selected' : ''; ?>>8 Gb</option>
                    <option value="12" <?php echo $row["ram_hp"] == 12 ? 'selected' : ''; ?>> 12 Gb</option>
                    <option value="16" <?php echo $row["ram_hp"] == 16 ? 'selected' : ''; ?>> 16 Gb</option>
                    <option value="32" <?php echo $row["ram_hp"] == 32 ? 'selected' : ''; ?>> 32 Gb</option>
                    <option value="64" <?php echo $row["ram_hp"] == 64 ? 'selected' : ''; ?>> 64 Gb</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><label for="memorys"><b>Memori</b></label></td>
                <td>
                  <select class="form-control" style="display: block; margin-bottom: 4px;" required name="memorys">
                    <option value="16" <?php echo $row["memori_hp"] == 16 ? 'selected' : ''; ?>>16 GB</option>
                    <option value="32" <?php echo $row["memori_hp"] == 32 ? 'selected' : ''; ?>>32 GB</option>
                    <option value="64" <?php echo $row["memori_hp"] == 64 ? 'selected' : ''; ?>>64 GB</option>
                    <option value="128" <?php echo $row["memori_hp"] == 128 ? 'selected' : ''; ?>>128 GB</option>
                    <option value="256" <?php echo $row["memori_hp"] == 256 ? 'selected' : ''; ?>>256 GB</option>
                    <option value="512" <?php echo $row["memori_hp"] == 512 ? 'selected' : ''; ?>>512 GB</option>
                    <option value="1024" <?php echo $row["memori_hp"] == 1024 ? 'selected' : ''; ?>>1 TB</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><label for="processors"><b>Memori</b></label></td>
                <td>
                  <select class="form-control" style="display: block; margin-bottom: 4px;" required name="processors">
                    <option value="Dualcore" <?php echo $row["processor_hp"] == 'Dualcore' ? 'selected' : ''; ?>>Dualcore</option>
                    <option value="Quadcore" <?php echo $row["processor_hp"] == 'Quadcore' ? 'selected' : ''; ?>>Quadcore</option>
                    <option value="Octacore" <?php echo $row["processor_hp"] == 'Octacore' ? 'selected' : ''; ?>>Octacore</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><label for="kameras"><b>Kamera</b></label></td>
                <td><input class="form-control" type="text" name="kameras" value="<?php echo $row["kamera_hp"]; ?>"></td>
              </tr>
              <tr>
                <td><label for="stoks"><b>Stok</b></label></td>
                <td><input class="form-control" type="text" name="stoks" value="<?php echo $row["stock"]; ?>"></td>
              </tr <tr>
              <td><label for="gambarHp"><b>Gambar Buku</b></label></td>
              <td><img width="100" src="../assets/img/<?= $row['image']; ?>" alt=""><br>
                <input class="form-control" type="file" name="gambarHp">
              </td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <button type="submit" style="float: right;" class="mt-5 mb-5 btn btn-primary" name="Edit">Editkan Lee</button>
                  <a href="buku.php" type="submit" style="float: right;" class="mt-5 mr-2 mb-5 btn btn-secondary" name="Edit">Back</a>
                </td>
              </tr>
            </table>
          </form>
        </div>
      <?php endwhile; ?>

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
  <!--  dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>
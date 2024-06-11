<?php
session_start();
if (!isset($_SESSION["login"]) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
  header("location:../login");
  exit;
}


$conn = mysqli_connect('localhost', 'root', '', "db_pkl");

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE idPelanggan=$id");
  $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $level = $_POST['level'];

  mysqli_query($conn, "UPDATE pelanggan SET username='$username', nama='$nama', email='$email', level='$level' WHERE idPelanggan=$id");
  header("Location: list_anggota.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Jaya Ponsel | Edit Data Anggota</title>
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
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="../assets/img/2.jpg" style="width: 30px;" alt="User Avatar" class="mr-2 img-circle">
            <?php echo $_SESSION['level']; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="../logout.php" class="dropdown-item">
              <div class="media">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Logout
                  </h3>
                  <p class="text-sm">Keluar dari Akun</p>
                </div>
              </div>
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/Logo.png" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel -->
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
            <li class="nav-item">
              <a href="./" class="nav-link">
                <i class="nav-icon fas fa-tachometer"></i>
                <p>
                  Dashboard
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
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
                  <a href="list_admin.php" class="nav-link ">
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
                  <a href="hp.php" class="nav-link">
                    <i class="nav-icon fa fa-book"></i>
                    <p>Catalog HP</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="tambah.php" class="nav-link">
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

    <!-- Content Wrapper -->
    <div class="content-wrapper" style="padding: 20px">
      <!-- Content Header -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Edit User</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home Admin</a></li>
                <li class="breadcrumb-item ">User Management</li>
                <li class="breadcrumb-item active">Edit User</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="">
        <form method="POST" action="">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
          </div>
          <div class="form-group">
            <label for="nama">Name:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
          </div>
          <div class="form-group">
            <label for="level">Level:</label>
            <input type="text" class="form-control" id="level" name="level" value="<?php echo $row['level']; ?>" required>
          </div>
          <button type="submit" class="btn btn-primary" name="update">Update</button>
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
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
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
  <script src="dist/js/demo.js"></script>
</body>

</html>

</body>

</html>
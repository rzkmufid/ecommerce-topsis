<?php
session_start();
if (!isset($_SESSION["login"]) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
  header("location:../login");
  exit;
}


$conn = mysqli_connect('localhost', 'root', '', "db_pkl");

// Fetch users with 'user' level
$result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE level='user'");

if (isset($_POST["cari"])) {
  $cari = $_POST["keyword"];
  $q = "SELECT * FROM pelanggan WHERE
	(username LIKE '%$cari%' OR email LIKE '%$cari%' OR nama LIKE '%$cari%') AND level='user'";
  $result = mysqli_query($conn, $q);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Jaya Ponsel | List Anggota</title>

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
                                    <a href="list_anggota.php" class="nav-link active">
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
                            <h1 class="m-0">User Management</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home Admin</a></li>
                                <li class="breadcrumb-item active">User Management</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- Search Form -->
                    <form method="POST" action="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="keyword" placeholder="Search for users">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" name="cari">Search</button>
                            </div>
                        </div>
                    </form>

                    <!-- User Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
              $i = 1;
              while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row["nama"]; ?></td>
                                <td><?php echo $row["username"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row["level"]; ?></td>
                                <td>
                                    <a href="edit_anggota.php?id=<?php echo $row['idPelanggan']; ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="hapus_anggota.php?id=<?php echo $row['idPelanggan']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                </td>
                            </tr>
                            <?php $i++;
              endwhile; ?>
                        </tbody>
                    </table>
                </div>
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
    <script src="dist/js/demo.js"></script>
    <!--  dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="https://kit.fontawesome.com/be8f875c1c.js" crossorigin="anonymous"></script>
</body>

</html>
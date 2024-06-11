<?php
session_start();
$koneksi = mysqli_connect('localhost', 'root', '', "db_pkl");

// session_start();
if (isset($_SESSION["level"]) == 'admin') {
	header("location:../admin/");
	exit;
} else if (isset($_SESSION["level"]) == 'user') {
	header("location:../");
	exit;
}

if (isset($_POST['input'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE username='$username' AND password='$password'");
	$row = mysqli_fetch_assoc($result);

	if (mysqli_num_rows($result) === 1) {

		if ($row['level'] == "admin") {
			$_SESSION['login'] = true;
			$_SESSION['id'] = $row['idPelanggan'];
			$_SESSION['level'] = $row['level'];
			header("location:../admin/");
		} else if ($row['level'] == "user") {
			$_SESSION['login'] = true;
			$_SESSION['id'] = $row['idPelanggan'];
			$_SESSION['level'] = $row['level'];
			// $_SESSION['username'] = $username;
			// setcookie('login', 'true');

			header("location:../");
		} else if ($row['level'] == "superadmin") {
			$_SESSION['login'] = true;
			$_SESSION['id'] = $row['idPelanggan'];
			$_SESSION['level'] = $row['level'];
			header("location:../admin/");
		} else {
			// header("location:index.php?pesan=gagal");
			echo "
					<script>
					alert('LOGIN GAGAL');
					document.location.href='index.php';
					</script>
				";
		}
	} else {
		// header("location:index.php?pesan=gagalcoy");
		echo "
					<script>
					alert('LOGIN GAGAL');
					document.location.href='index.php';
					</script>
				";
	}
}
?>

<!-- <!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
</head>
<body>
	<h1>Halaman Login</h1>
	<div class="form">
		<form  method="post"  name="form_input">
			<div class="username">
				username : <input type="text" name="username" placeholder="Masukan Username" required="">
			</div>
			<div class="password">
				password : <input type="password" name="password" placeholder="Masukan Password" required="">
			</div>
			<div>
				<input type="checkbox" name="remember" >
				<label for="remember"> Remember me</label>
			</div>

			<div class="tombol">
				<input type="submit" name="input" value="LOGIN">
				<input type="reset" name="input" value="RESET">
			</div>

		</form>
	</div>
	<a href="daftar.php"><button>Daftar</button></a>
</body>
</html>
 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login </title>
    <link rel="stylesheet" href="../assets/css/login.css" />
</head>

<body>
    <div class="loginMetaverse">
        <div class="box">
            <div class="bLeft">
                <form method="POST" name="form_input">
                    <h1>Login</h1>

                    <div class="mb-20">
                        <label for="username" class="label">Username</label>
                        <br />
                        <input type="text" name="username" alt="Username" placeholder="Username" />
                        <br />
                    </div>

                    <div class="mb-20">
                        <label for="password" class="label">Password</label> <br />
                        <input type="password" name="password" alt="Password" placeholder="Password" />
                        <br />
                    </div>

                    <button type="submit" name="input" class="btn-login mb-20">Login</button>
                </form>
                <p>Belum punya akun? <a href="register.php">Daftar disini.</a></p>
            </div>
            <div class="bRight"></div>
        </div>
    </div>
</body>

</html>
<?php
session_start();
$koneksi = mysqli_connect('localhost', 'root', '', "db_pkl");

if (isset($_SESSION["level"]) == 'admin') {
    header("location:../admin/");
    exit;
} else if (isset($_SESSION["level"]) == 'user') {
    header("location:../");
    exit;
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $name = $_POST['nama'];
    $email = $_POST['email'];

    if ($password !== $confirm_password) {
        echo "<script>
					alert('Passwords do not match');
					document.location.href='register.php';
				  </script>";
        exit;
    }

    // Check if the username or email already exists
    $result = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE username='$username' OR email='$email'");
    if (mysqli_num_rows($result) > 0) {
        echo "<script>
					alert('Username or Email already exists');
					document.location.href='register.php';
				  </script>";
        exit;
    }

    // Insert new user into the database
    $query = "INSERT INTO pelanggan (username, password, level, nama, email) VALUES ('$username', '$password', 'user', '$name', '$email')";
    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>
					alert('Registration successful. Please log in.');
					document.location.href='index.php';
				  </script>";
    } else {
        echo "<script>
					alert('Registration failed');
					document.location.href='register.php';
				  </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register </title>
    <link rel="stylesheet" href="../assets/css/login.css" />
</head>

<body>
    <div class="loginMetaverse">
        <div class="box">
            <div class="bLeft">
                <form method="POST" name="form_register">
                    <h1>Register</h1>
                    <div class="mb-20">
                        <label for="nama" class="label">Name</label>
                        <br />
                        <input type="text" name="nama" alt="nama" placeholder="nama" required />
                        <br />
                    </div>


                    <div class="mb-20">
                        <label for="email" class="label">Email</label>
                        <br />
                        <input type="email" name="email" alt="Email" placeholder="Email" required />
                        <br />
                    </div>

                    <div class="mb-20">
                        <label for="username" class="label">Username</label>
                        <br />
                        <input type="text" name="username" alt="Username" placeholder="Username" required />
                        <br />
                    </div>

                    <div class="mb-20">
                        <label for="password" class="label">Password</label> <br />
                        <input type="password" name="password" alt="Password" placeholder="Password" required />
                        <br />
                    </div>

                    <div class="mb-20">
                        <label for="confirm_password" class="label">Confirm Password</label> <br />
                        <input type="password" name="confirm_password" alt="Confirm Password" placeholder="Confirm Password" required />
                        <br />
                    </div>

                    <button type="submit" name="register" class="btn-login mb-20">Register</button>
                </form>
                <p>Sudah punya akun? <a href="index.php">Login disini.</a></p>
            </div>
            <div class="bRight"></div>
        </div>
    </div>
</body>

</html>
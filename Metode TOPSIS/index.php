<?php
session_start();
include "koneksi/config.php";

if (isset($_GET['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'");
    $row = mysqli_num_rows($data);
    if ($row > 0) {
        $a = mysqli_fetch_array($data);

        // Simpan level user di session
        $_SESSION['level'] = $a['level']; 

        if ($a['level'] == 'admin_level') {
            $_SESSION['username'] = $username;
            header("location:admin/index.php");
            exit();
        } else if ($a['level'] == 'user_level') {
            $_SESSION['username'] = $username;
            header("location:user/index.php"); // Redirect ke halaman user
            exit();
        }
    } else {
        header("location:index.php?pesan=gagal");
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Login</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
      .container {
            margin-top: 100px;
        }
      .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
      .btn-primary {
            background-color: black;
            border-color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card animate__animated animate__fadeInDown">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="assets/images/Logo.jpg" alt="Logo" class="img-fluid" style="max-width: 200px;"> 
                        </div>
                        <form action="index.php?login=admin" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="register.php" class="animate__animated animate__fadeInUp">Belum punya akun? Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
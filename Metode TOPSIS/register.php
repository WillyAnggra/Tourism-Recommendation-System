<?php
include "koneksi/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $password = $_POST['password'];
    $level = "user_level"; // Level otomatis di-set ke "user_level"

    $errorMessages = []; // Array untuk menyimpan pesan error

    // Cek apakah username sudah ada di database
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE username =?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errorMessages = "Username sudah terdaftar.";
    }

    // Cek apakah email sudah ada di database
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE email =?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errorMessages = "Email sudah terdaftar.";
    }

    // Cek apakah nohp sudah ada di database
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE nohp =?");
    $stmt->bind_param("s", $nohp);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errorMessages = "Nohp sudah terdaftar.";
    }

    // Jika tidak ada error, lanjutkan dengan proses registrasi
    if (empty($errorMessages)) {
        $stmt = $conn->prepare("INSERT INTO tbl_user (username, email, nohp, password, level) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $username, $email, $nohp, $password, $level);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Registrasi berhasil.</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 300);</script>"; 
        } else {
            echo "<div class='alert alert-danger'>Error: ". $stmt->error. "</div>";
        }
    } else {
        // Tampilkan pesan error
        if (is_array($errorMessages)) {
            foreach ($errorMessages as $errorMessage) {
                echo "<div class='alert alert-danger'>$errorMessage</div>";
            }
        } else if (is_string($errorMessages)) {
            echo "<div class='alert alert-danger'>$errorMessages</div>";
        }
    }

    $stmt->close();
    $conn->close();
} ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Register</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card animate__animated animate__fadeInDown">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Register</h3>
                        <form method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="nohp">No. HP:</label>
                                <input type="text" class="form-control" name="nohp" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="index.php" class="animate__animated animate__fadeInUp">Sudah punya akun? Login</a>
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
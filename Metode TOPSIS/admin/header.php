<?php
error_reporting(0);
session_start();
include "../koneksi/config.php";
include "../koneksi/cek.php";
?>

<!doctype html>
<html lang="en">

<head>
    <title>SISTEM PENGAMBILAN KEPUTUSAN TOPSIS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS CDN -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css-sidebar/css/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        /* Membuat sidebar tetap terlihat dan mengikuti scroll */
        /* Perbaikan Sidebar */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #ffffff;
            /* Pastikan sidebar memiliki warna solid */
            border-right: 2px solid #ddd;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* Perbaikan Teks Sidebar */
        #sidebar a {
            color: #333 !important;
            /* Warna teks sidebar lebih gelap */
            font-weight: 600;
        }

        /* Perbaikan Hover */
        #sidebar a:hover {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        /* Perbaikan untuk Konten Utama */
        #content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
        }


        /* Styling Navbar */
        #sidebar .list-unstyled {
            padding-left: 10px;
        }

        #sidebar a {
            color: black;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            transition: 0.3s;
        }

        #sidebar a:hover {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        #sidebar .active a {
            font-weight: bold;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        /* Styling Logo */
        .logo-container {
            text-align: center;
            padding: 10px;
            margin-left: 70px;
        }

        .logo-container img {
            max-width: 80px;
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex">
        <nav id="sidebar">
            <div class="logo-container">
                <img src="../assets/images/Icon.png" alt="Logo">
            </div>
            <div class="p-4">
                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="index.php"><i class="fa fa-home mr-3"></i> Home</a>
                    </li>
                    <li>
                        <a href="data.php"><i class="bi bi-table mr-3"></i> Proses TOPSIS</a>
                    </li>
                    <li>
                        <a href="hasil.php"><i class="bi bi-check2-all mr-3"></i> Hasil</a>
                    </li>
                    <li>
                        <a href="laporan.php"><i class="bi bi-printer-fill mr-3"></i> Laporan</a>
                    </li>
                    <li>
                        <a href="grafik.php"><i class="bi bi-bar-chart-fill mr-3"></i> Grafik Hasil</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="bi bi-box-arrow-right mr-3"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Konten Utama -->
        <div id="content">
            <div class="container">
                <!-- Page content goes here -->

                <!-- JavaScript -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

</body>

</html>
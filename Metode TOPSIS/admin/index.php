<?php include "header.php"; ?>

<style>
  body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    color: #333;
  }

  /* Hero Section */
  .hero {
    background-color: #2980b9; /* Warna latar belakang biru */
    color: white;
    padding: 100px 0;
    position: relative; /* Untuk mengatur posisi elemen anak */
    overflow: hidden; /* Menyembunyikan elemen yang keluar dari container */
  }

  .hero .container {
    position: relative; /* Untuk mengatur posisi elemen anak */
    z-index: 2; /* Menempatkan konten di atas background */
  }

  .hero h1 {
    font-size: 3.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
  }

  .hero p {
    font-size: 1.25rem;
    margin-bottom: 2rem;
  }

  .hero .btn {
    background-color: #3498db;
    border-color: #3498db;
  }

  /* Parallax Effect */
  .hero:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('../assets/images/parallax-admin.jpg'); /* Ganti dengan gambar background */
    background-size: cover;
    background-position: center;
    background-attachment: fixed; /* Efek parallax */
    z-index: 1; /* Menempatkan background di bawah konten */
    opacity: 0.5; /* Mengatur transparansi background */
  }

  .hero .btn:active {
  transform: scale(0.95); /* Memperkecil ukuran tombol saat ditekan */
  transition: transform 0.1s ease; /* Transisi yang halus selama 0.1 detik */
}

  /* Dekorasi */
  .hero .plus {
    position: absolute;
    font-size: 3rem;
    color: rgba(255, 255, 255, 0.3); /* Warna putih transparan */
  }

  .hero .plus-1 {
    top: 20px;
    left: 50px;
  }

  .hero .plus-2 {
    bottom: 20px;
    right: 50px;
  }

  .hero .line {
    position: absolute;
    width: 100px;
    height: 2px;
    background-color: rgba(255, 255, 255, 0.3); /* Warna putih transparan */
  }

  .hero .line-1 {
    top: 50px;
    left: 100px;
    transform: rotate(45deg);
  }

  .hero .line-2 {
    bottom: 50px;
    right: 100px;
    transform: rotate(-45deg);
  }

  .hero .circle {
    position: absolute;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.3); /* Warna putih transparan */
  }

  .hero .circle-1 {
    top: 100px;
    left: 200px;
  }

  .hero .circle-2 {
    bottom: 100px;
    right: 200px;
  }
</style>

<section class="hero">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h1>Selamat Datang Admin</h1>
        <p>Sistem Pendukung Keputusan Metode TOPSIS untuk Membantu Anda Memilih Objek Wisata di Kabupaten Merangin</p>
        <a href="data.php" class="btn btn-lg">Mulai Kelola Data</a>
      </div>
    </div>
  </div>

  <div class="plus plus-1">+</div>
  <div class="plus plus-2">+</div>
  <div class="line line-1"></div>
  <div class="line line-2"></div>
  <div class="circle circle-1"></div>
  <div class="circle circle-2"></div>
</section>

<?php include "footer.php"; ?>
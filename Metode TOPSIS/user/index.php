<?php include "header.php";?>

<style>
  /* Hero Section */
.hero {
    background-image: url('../assets/images/top.png'); /* Ganti dengan gambar pilihanmu */
    background-size: cover;
    background-position: center;
    min-height: 400px;
    display: flex;
    align-items: center;
    text-align: center;
    color: white;
  }

.hero h1 {
    font-size: 3.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    color: white;
  }

.hero p {
    font-size: 1.25rem;
  }

  /* About Section */
.about {
    background-color: #f8f9fa; /* Warna latar belakang abu-abu muda */
  }

.about h2 {
    font-weight: bold;
    margin-bottom: 1rem;
  }

  /* Features Section */
.features {
    background-color: white;
  }

.features.card {
    border: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease;
  }

.features.card:hover {
    transform: translateY(-5px);
  }

.features i {
    font-size: 3rem;
    color: #007bff; /* Warna biru */
  }

.btn-cari {
    background-color: #FFE31A;
    border-color: #FFE31A;
  }

.btn-cari:active {
    transform: scale(0.95);
    transition: transform 0.1s ease;
  }

  /* CSS untuk gambar di hasil.php dan detail.php */
.objek-wisata-list img, #content.container img {
    width: 100%; /* Lebar gambar memenuhi container */
    height: 200px; /* Tinggi gambar 200px */
    object-fit: cover; /* Menyesuaikan gambar agar pas dengan container tanpa mengubah rasio */
  }
</style>

<section class="hero">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="text-white">Temukan Destinasi Wisata Terbaik</h1> 
        <p>Sistem Pendukung Keputusan Metode TOPSIS untuk Membantu Anda Memilih Objek Wisata di Kabupaten Merangin</p>
        <a href="hasil.php" class="btn btn-lg btn-cari" style="background-color: #F4CE14; border-color: #F4CE14; color: white;">Cari Sekarang</a>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container mx-auto"> <h2 class="mb-4 text-2xl font-bold text-center">Objek Wisata Populer Saat Ini</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 objek-wisata-list">
      <?php
      include '../koneksi/config.php';

      // Query untuk mengambil 3 objek wisata dengan rank tertinggi
      $sql = "SELECT 
            h.rank,
            a.nama_alternatif,
            d.gambar,
            d.harga_tiket,
            d.jarak,
            d.id
        FROM 
            tbl_hasil h
        JOIN 
            tbl_alternatif a ON h.kode_alternatif = a.kode_alternatif
        JOIN 
            tbl_data d ON a.nama_alternatif = d.nama_objek_wisata
        ORDER BY 
            h.rank 
        LIMIT 3";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='objek-wisata' data-jenis='". $row['jenis']. "'>";
          echo "<div class='bg-white shadow-md rounded-lg overflow-hidden'>";
          echo "<img src='../assets/images/". $row['gambar']. "' alt='". $row['nama_alternatif']. "' class='w-full'>";
          echo "<div class='p-4'>";
          echo "<h5 class='text-lg font-bold mb-2'>". $row['nama_alternatif']. "</h5>";
          echo "<p class='text-gray-700 text-base'>Harga Tiket : Rp. ". number_format($row['harga_tiket'], 0, ',', '.'). "</p>";
          echo "<p class='text-gray-700 text-base'>Jarak dari Ibu Kota Kab : ". $row['jarak']. " km</p>";
          // Tombol Lihat Detail
          echo "<a href='detail.php?id=". $row['id']. "' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block'>Lihat Detail</a>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
        }
      } else {
        echo "<p class='text-center'>Tidak ada objek wisata populer saat ini.</p>";
      }
    ?>
    </div>
  </div>
</section>

<section class="about py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <img src="../assets/images/about.png" alt="Tentang Kami" class="img-fluid rounded">
      </div>
      <div class="col-md-6">
        <h2>Tentang Kami</h2>
        <p>Website ini dibuat untuk membantu wisatawan menemukan objek wisata terbaik di Kabupaten Merangin. Kami menggunakan metode TOPSIS untuk menentukan peringkat objek wisata berdasarkan kriteria yang telah ditentukan.</p>
      </div>
    </div>
  </div>
</section>

<section class="features py-5">
  <div class="container">
    <h2 class="text-center mb-4">Fitur Unggulan</h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-body text-center">
            <i class="fas fa-search"></i>
            <h5 class="card-title mt-3">Cari Berdasarkan Kriteria</h5>
            <p class="card-text">Cari objek wisata berdasarkan harga tiket, jarak, dan fasilitas.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-body text-center">
            <i class="fas fa-star"></i>
            <h5 class="card-title mt-3">Rekomendasi Terbaik</h5>
            <p class="card-text">Dapatkan rekomendasi objek wisata terbaik berdasarkan perhitungan TOPSIS.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-body text-center">
            <i class="fas fa-map-marked-alt"></i>
            <h5 class="card-title mt-3">Mudah Digunakan</h5>
            <p class="card-text">Tampilan yang mudah digunakan dan informatif.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include "footer.php";?>
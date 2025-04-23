<?php
include '../koneksi/config.php';

// Fungsi buildWhereClause() yang sudah diperbaiki
function buildWhereClause($harga, $jarak) {
    $where = [];

    if (!empty($harga)) { // Periksa apakah $harga tidak kosong
        if ($harga == '<10000') {
            $where[] = "harga_tiket < 10000";
        } else if ($harga == '10000-50000') {
            $where[] = "harga_tiket BETWEEN 10000 AND 50000";
        } else if ($harga == '50000-100000') {
            $where[] = "harga_tiket BETWEEN 50000 AND 100000";
        } else if ($harga == '>100000') {
            $where[] = "harga_tiket > 100000";
        }
    }

    if (!empty($jarak)) { // Periksa apakah $jarak tidak kosong
        if ($jarak == '<25') {
            $where[] = "jarak < 25";
        } else if ($jarak == '25-50') {
            $where[] = "jarak BETWEEN 25 AND 50";
        } else if ($jarak == '50-100') {
            $where[] = "jarak BETWEEN 50 AND 100";
        } else if ($jarak == '>100') {
            $where[] = "jarak > 100";
        }
    }

    if (count($where) > 0) {
        return " WHERE " . implode(" AND ", $where);
    } else {
        return "";
    }
}

// Ambil data filter dari AJAX request
$harga = isset($_GET['harga']) ? $_GET['harga'] : '';
$jarak = isset($_GET['jarak']) ? $_GET['jarak'] : '';

// Query untuk mengambil data dengan JOIN dan filter
$sql = "SELECT 
            d.nama_objek_wisata, 
            d.harga_tiket, 
            d.fasilitas, 
            d.jarak, 
            d.jumlah_wisatawan, 
            h.rank,
            a.kode_alternatif,
            d.gambar
        FROM 
            tbl_data d
        JOIN 
            tbl_alternatif a ON d.nama_objek_wisata = a.nama_alternatif
        JOIN 
            tbl_hasil h ON a.kode_alternatif = h.kode_alternatif";  

$sql .= buildWhereClause($harga, $jarak); // Tambahkan klausa WHERE
$result = $conn->query($sql);

if ($result->num_rows > 0):
?>
<div class="row">
  <?php while ($row = $result->fetch_assoc()): ?>
  <div class="col-md-4 mb-4">
    <div class="card">
      <img src="../assets/images/<?php echo $row["gambar"]; ?>" class="card-img-top" alt="<?php echo $row["nama_objek_wisata"]; ?>">
      <div class="card-body">
        <h5 class="card-title"><?php echo $row["nama_objek_wisata"]; ?></h5>
        <p class="card-text">
          Harga Tiket: Rp. <?php echo number_format($row["harga_tiket"], 0, ',', '.'); ?><br>
          Jarak: <?php echo $row["jarak"]; ?> KM<br>
          Fasilitas: <?php echo $row["fasilitas"]; ?> dari 5 Fasilitas<br>
          Jumlah Wisatawan: <?php echo number_format($row["jumlah_wisatawan"], 0, ',', '.'); ?> Orang
        </p>
      </div>
    </div>
  </div>
  <?php endwhile; ?>
</div>
<?php else: ?>
<div class="col-md-12">
  <p>Tidak ada objek wisata yang sesuai dengan kriteria pencarian.</p>
</div>
<?php endif; ?>
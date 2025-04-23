<?php
include '../koneksi/config.php';

// Set timezone ke waktu lokal Anda
date_default_timezone_set('Asia/Jakarta');

// Ambil data dari form input tanda tangan (jika ada)
$namaPenandatangan = isset($_POST['nama']) ? $_POST['nama'] : '';
$jabatanPenandatangan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';
$tempatPenandatangan = isset($_POST['tempat']) ? $_POST['tempat'] : '';

// Dapatkan tanggal otomatis sesuai hari ini
$tanggalCetak = date("d F Y");  // Format: 09 September 2024
$waktuCetak = date("H:i:s");    // Format waktu: 04:10:32

include "header.php";
?>

<style>
    @media print {

        /* Sembunyikan elemen-elemen yang tidak perlu dicetak */
        nav,
        .btn,
        footer,
        form,
        .tbl,
        .form-group {
            display: none !important;
        }
    }

    .signature-container {
        text-align: center;
        margin-right: 0;
        margin-top: 50px;
        position: relative;
        width: 100%;
        display: flex;
        justify-content: flex-end;
    }

    .signature-content {
        text-align: center;
        width: 300px;
    }

    .signature-content .location-date {
        margin-bottom: 10px;
    }

    .signature-content .position {
        font-weight: bold;
        margin-bottom: 70px;
    }

    .signature-content .name {
        font-weight: bold;
        margin-bottom: 5px;
        /* Mengatur jarak antara nama dan garis agar lebih dekat */
    }

    .signature-content .signature-line {
        margin-top: 0px;
        /* Menghapus jarak antara nama dan garis tanda tangan */
        border-top: 1px solid black;
        width: 200px;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <img src="../assets/images/Icon.png" alt="Logo" style="width: 135px; margin-right: 20px;">
                <div>
                    <h4>PEMERINTAH KABUPATEN MERANGIN</h4>
                    <p>Telpon : (0746) 323198</p>
                    <p>Pematang Kandis, Kec. Bangko, Kabupaten Merangin, Jambi, 37313</p>
                    <p>website : https://meranginkab.go.id/</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 text-center">
            <h4>Laporan Hasil TOPSIS</h4>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table">
            <thead>
                <tr>
                    <th>Kode Alternatif</th>
                    <th>Nama Objek Wisata</th>
                    <th>Harga Tiket</th>
                    <th>Fasilitas</th>
                    <th>Jarak dari Ibu Kota Kab.</th>
                    <th>Jumlah Wisatawan</th>
                    <th>Total Nilai</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil data dengan JOIN dan susunan kolom yang diinginkan
                $sql = "SELECT 
                            tbl_alternatif.kode_alternatif, 
                            tbl_alternatif.nama_alternatif, 
                            tbl_data.harga_tiket, 
                            tbl_data.fasilitas, 
                            tbl_data.jarak, 
                            tbl_data.jumlah_wisatawan, 
                            tbl_hasil.total_nilai, 
                            RANK() OVER (ORDER BY tbl_hasil.total_nilai DESC) AS rank
                        FROM 
                            tbl_alternatif
                        JOIN 
                            tbl_data ON tbl_alternatif.nama_alternatif = tbl_data.nama_objek_wisata
                        JOIN 
                            tbl_hasil ON tbl_alternatif.kode_alternatif = tbl_hasil.kode_alternatif";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["kode_alternatif"] . "</td>";
                        echo "<td>" . $row["nama_alternatif"] . "</td>";
                        echo "<td>Rp. " . $row["harga_tiket"] . "</td>";
                        echo "<td>" . $row["fasilitas"] . " dari 5 Fasilitas</td>";
                        echo "<td>" . $row["jarak"] . " KM</td>";
                        echo "<td>" . $row["jumlah_wisatawan"] . " Orang</td>";
                        echo "<td>" . $row["total_nilai"] . "</td>";
                        echo "<td>" . $row["rank"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <hr>
    <form method="POST" class="mb-4">
        <div class="form-group mt-3">
            <label for="tempat">Tempat:</label>
            <input type="text" name="tempat" id="tempat" class="form-control" placeholder="Masukkan Tempat" value="<?php echo htmlspecialchars($tempatPenandatangan); ?>" required>
        </div>
        <div class="form-group mt-3">
            <label for="nama">Nama Penandatangan:</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" value="<?php echo htmlspecialchars($namaPenandatangan); ?>" required>
        </div>
        <div class="form-group mt-2">
            <label for="jabatan">Jabatan Penandatangan:</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Masukkan Jabatan" value="<?php echo htmlspecialchars($jabatanPenandatangan); ?>" required>
        </div>

        <button type="submit" name="simpan" class="btn btn-success mt-3">Simpan Data Penandatangan</button>

        <button type="button" class="btn btn-dark mt-3" onclick="window.print()">Cetak Laporan</button>
    </form>

    <div class="signature-container">
        <div class="signature-content">
            <p class="location-date"><?php echo htmlspecialchars($tempatPenandatangan); ?>, <?php echo $tanggalCetak; ?></p>
            <p class="position"><?php echo htmlspecialchars($jabatanPenandatangan); ?></p>
            <p class="name"><?php echo htmlspecialchars($namaPenandatangan); ?></p>
            <div class="signature-line"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <p>Di cetak pada: <?php echo $tanggalCetak; ?> Jam: <?php echo $waktuCetak; ?></p>
        </div>
    </div>

    <?php include "footer.php"; ?>
</div>
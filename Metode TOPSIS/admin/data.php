<?php
include "../koneksi/config.php";
include "header.php";

// Fungsi untuk menangani kesalahan query database
function handle_query_error($conn, $query) {
    die("Error in query: " . $query . " - " . mysqli_error($conn));
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $id = $_GET['id'];

        // Hapus gambar dari folder
        $gambarQuery = mysqli_query($conn, "SELECT gambar FROM tbl_data WHERE id='$id'");
        if (!$gambarQuery) handle_query_error($conn, "SELECT gambar FROM tbl_data WHERE id='$id'");

        $gambarData = mysqli_fetch_assoc($gambarQuery);
        if ($gambarData['gambar']) {
            $gambarPath = '../assets/images/' . $gambarData['gambar'];
            if (file_exists($gambarPath)) {
                if (!unlink($gambarPath)) {
                    echo "Gagal menghapus gambar: " . $gambarPath;
                }
            }
        }

        // Hapus data dari database
        $deleteQuery = mysqli_query($conn, "DELETE FROM tbl_data WHERE id='$id'");
        if (!$deleteQuery) handle_query_error($conn, "DELETE FROM tbl_data WHERE id='$id'");

        header("location:data.php");
    }
}

// Ambil semua kolom dari tabel tbl_data
$queryColumns = mysqli_query($conn, "SHOW COLUMNS FROM tbl_data");
if (!$queryColumns) handle_query_error($conn, "SHOW COLUMNS FROM tbl_data");

$columns = [];
while ($col = mysqli_fetch_assoc($queryColumns)) {
    // Kecualikan kolom 'id', 'gambar', 'jenis', 'penjelasan', dan 'gmaps'
    if (!in_array($col['Field'], ['id', 'gambar','jenis', 'penjelasan', 'gmaps'])) {
        $columns[] = $col['Field'];
    }
}
?>

<h2 class="mb-4">DATA OBJEK WISATA</h2>
<hr>
<div class="shadow p-5">
    <a href="data-add.php" class="btn btn-dark mb-3"><span class="fa fa-plus">Tambah Data</span></a>
    <hr>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle">No</th>
                    <?php foreach ($columns as $columnName) : ?>
                        <th class="text-center align-middle">
                            <?php
                            if ($columnName == 'harga_tiket') {
                                echo "Harga Tiket";
                            } elseif ($columnName == 'fasilitas') {
                                echo "Fasilitas";
                            } elseif ($columnName == 'jarak') {
                                echo "Jarak dari Ibu Kota Kab.";
                            } elseif ($columnName == 'jumlah_wisatawan') {
                                echo "Jumlah Wisatawan";
                            } else {
                                echo ucwords(str_replace('_', ' ', $columnName));
                            }
                            ?>
                        </th>
                    <?php endforeach; ?>
                    <th class="text-center align-middle">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = mysqli_query($conn, "SELECT * FROM tbl_data ORDER BY id");
                if (!$data) handle_query_error($conn, "SELECT * FROM tbl_data ORDER BY id");

                $no = 1;
                while ($row = mysqli_fetch_assoc($data)) : ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <?php foreach ($columns as $columnName) : ?>
                            <td class="text-center">
                                <?php
                                if ($columnName == 'harga_tiket') {
                                    echo "Rp. " . number_format($row[$columnName], 0, ',', '.');
                                } elseif ($columnName == 'gambar') {
                                    // Tampilkan gambar
                                    echo '<img src="../assets/images/' . $row[$columnName] . '" alt="' . $row['nama_objek_wisata'] . '" width="100">';
                                } elseif ($columnName == 'jarak') {
                                    echo $row[$columnName] . " KM";
                                } elseif ($columnName == 'fasilitas') {
                                    echo $row[$columnName] . " dari 5 Fasilitas";
                                } elseif ($columnName == 'jumlah_wisatawan') {
                                    echo $row[$columnName] . " Orang";
                                } else {
                                    echo htmlspecialchars($row[$columnName]);
                                }
                                ?>
                            </td>
                        <?php endforeach; ?>
                        <td class="text-center">
                            <a href="data-update.php?id=<?= $row['id'] ?>" class="btn btn-dark"><span class="fa fa-pencil"></span></a>
                            <a href="data.php?id=<?= $row['id'] ?>&aksi=hapus" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- ALTERNATIF -->
 <br><br><br>
<?php
// Hapus semua data dalam tabel sebelum mengisi ulang
mysqli_query($conn, "TRUNCATE TABLE tbl_alternatif");

// Ambil data dari tbl_data
$data = mysqli_query($conn, "SELECT * FROM tbl_data ORDER BY id ASC");

?>
<h2 class="mb-4">ALTERNATIF</h2>
<hr>
<div class="shadow p-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode Alternatif</th>
                <th class="text-center">Nama Alternatif</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1; // Nomor urut mulai dari 1
            while ($row = mysqli_fetch_assoc($data)) {
                $kode_alternatif = 'A' . $no; // Format ulang kode alternatif
                $nama_alternatif = $row['nama_objek_wisata'];

                // Masukkan ulang data ke tbl_alternatif
                $insertQuery = "INSERT INTO tbl_alternatif (kode_alternatif, nama_alternatif) 
                                VALUES ('$kode_alternatif', '$nama_alternatif')";
                mysqli_query($conn, $insertQuery);
                ?>
                <tr>
                    <td class="text-center"><?= $no; ?></td>
                    <td class="text-center"><?= $kode_alternatif; ?></td>
                    <td class="text-center"><?= htmlspecialchars($nama_alternatif); ?></td>
                </tr>
            <?php 
                $no++; // Nomor bertambah
            } 
            ?>
        </tbody>
    </table>
</div>


<!-- KRITERIA -->
<br><br><br>
<?php
$queryColumns = mysqli_query($conn, "SHOW COLUMNS FROM tbl_data");
$columns = [];
while ($col = mysqli_fetch_assoc($queryColumns)) {
    if (($col['Field'] != 'id') && (strpos($col['Type'], 'int') !== false || strpos($col['Type'], 'float') !== false)) {
        $columns[] = $col['Field'];
    }
}

$bobotExists = $conn->query("SELECT COUNT(*) FROM tbl_kriteria")->fetch_row()[0] > 0;

if (isset($_GET['reset']) && $_GET['reset'] == 'true') {
    $conn->query("TRUNCATE TABLE tbl_kriteria");
    $conn->query("TRUNCATE TABLE tbl_hasil");
    $_SESSION['reset'] = true;
    $_SESSION['success'] = "Data berhasil direset!";
    unset($_SESSION['bobot']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$bobotExists) {
    if (isset($_SESSION['reset']) && $_SESSION['reset'] == true) {
        unset($_SESSION['reset']);
    } else {
        $weights = [];
        $namaKriteria = [];
        foreach ($columns as $index => $columnName) {
            $kodeKriteria = 'C' . ($index + 1);
            $weights[$kodeKriteria] = $_POST['bobot_' . $kodeKriteria];
            $namaKriteria[$kodeKriteria] = $_POST['nama_' . $kodeKriteria];
        }

        foreach ($weights as $kode => $bobot) {
            $nama = $namaKriteria[$kode];
            $cek = $conn->query("SELECT * FROM tbl_kriteria WHERE kode_kriteria='$kode'");
            if ($cek->num_rows > 0) {
                $conn->query("UPDATE tbl_kriteria SET bobot='$bobot', nama_kriteria='$nama' WHERE kode_kriteria='$kode'");
            } else {
                $conn->query("INSERT INTO tbl_kriteria (kode_kriteria, nama_kriteria, bobot) VALUES ('$kode', '$nama', '$bobot')");
            }
        }

        $_SESSION['success'] = "Data berhasil disimpan!";
    }
}

if ($bobotExists) {
    if (!isset($_SESSION['bobot'])) {
        $bobotQuery = $conn->query("SELECT * FROM tbl_kriteria");
        $weights = [];
        $namaKriteria = [];
        while ($row = $bobotQuery->fetch_assoc()) {
            $weights[$row['kode_kriteria']] = $row['bobot'];
            $namaKriteria[$row['kode_kriteria']] = $row['nama_kriteria'];
        }

        $_SESSION['bobot'] = [
            'weights' => $weights,
            'nama_kriteria' => $namaKriteria
        ];
    }
}

if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $_SESSION['success'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    unset($_SESSION['success']);
}
?>

<h2 class="mb-4">KRITERIA</h2>
<hr>
<div class="shadow p-5">
    <?php if (!$bobotExists && !isset($_SESSION['bobot'])): ?>
        <form id="form-bobot" method="POST">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode Kriteria</th>
                        <th class="text-center">Nama Kriteria</th>
                        <th class="text-center">Bobot</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($columns as $index => $columnName):
                        $kodeKriteria = 'C' . ($index + 1);
                        $namaKriteria = ucwords(str_replace('_', ' ', $columnName));
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $kodeKriteria ?></td>
                            <td class="text-center">
                                <input type="text" class="form-control" name="nama_<?= $kodeKriteria ?>" value="<?= $namaKriteria ?>" readonly>
                            </td>
                            <td class="text-center">
                                <input type="number" class="form-control" name="bobot_<?= $kodeKriteria ?>" required>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary" id="simpan-button">Simpan</button>
        </form>
    <?php else: ?>
        <table class="table table-bordered" id="tabel-kriteria">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Kode Kriteria</th>
                    <th class="text-center">Nama Kriteria</th>
                    <th class="text-center">Bobot</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($columns as $index => $columnName):
                    $kodeKriteria = 'C' . ($index + 1);
                    $namaKriteria = ucwords(str_replace('_', ' ', $columnName));
                    $bobotKriteria = isset($_SESSION['bobot']['weights'][$kodeKriteria]) ? $_SESSION['bobot']['weights'][$kodeKriteria] : '';
                    $namaKriteriaSession = isset($_SESSION['bobot']['nama_kriteria'][$kodeKriteria]) ? $_SESSION['bobot']['nama_kriteria'][$kodeKriteria] : $namaKriteria;
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $kodeKriteria ?></td>
                        <td class="text-center"><?= $namaKriteriaSession ?></td>
                        <td class="text-center"><?= $bobotKriteria ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<div id="hasil-topsis" class="container mt-5" style="display: none;"></div>

<div class="container mt-3">
    <?php if ($bobotExists || isset($_SESSION['bobot'])): ?>
        <a href="?reset=true" class="btn btn-danger" id="reset-button">Reset Data</a>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#form-bobot").submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "kriteria.php",
            data: $(this).serialize(),
            success: function(response) {
                $("#tabel-kriteria tbody").html($(response).find("#tabel-kriteria tbody").html());
                $("#hasil-topsis").html($(response).find(".alert").html()).show();
                setTimeout(function() {
                    $("#hasil-topsis").hide();
                }, 2000);
            }
        });
    });

    $("#reset-button").click(function() {
        $.ajax({
            type: "GET",
            url: "?reset=true",
            success: function() {
                location.reload();
            }
        });
    });
});
</script>

<!-- PERHITUNGAN TOPSIS -->
 <br>
<?php
// Fungsi untuk normalisasi matriks
function normalizeMatrix($matrix, $criteria)
{
    $normalized = [];
    foreach ($criteria as $key => $type) {
        $sum = 0;
        foreach ($matrix as $i => $row) {
            $sum += pow($row[$key], 2);
        }
        $sum = sqrt($sum);
        foreach ($matrix as $i => $row) {
            $normalized[$i][$key] = $row[$key] / $sum;
        }
    }
    return $normalized;
}

// Fungsi untuk menghitung matriks terbobot
function weightedMatrix($normalizedMatrix, $weights)
{
    $weighted = [];
    foreach ($normalizedMatrix as $i => $row) {
        foreach ($row as $key => $value) {
            $weighted[$i][$key] = $value * $weights[$key];
        }
    }
    return $weighted;
}

// Fungsi untuk menghitung solusi ideal
function idealSolution($weightedMatrix, $criteria)
{
    $idealPositive = [];
    $idealNegative = [];
    foreach ($criteria as $key => $type) {
        $values = array_column($weightedMatrix, $key);
        $idealPositive[$key] = $type == 'Benefit' ? max($values) : max($values); // Perbaikan: min($values) untuk Cost
        $idealNegative[$key] = $type == 'Benefit' ? min($values) : min($values); // Perbaikan: max($values) untuk Cost
    }
    return [$idealPositive, $idealNegative];
}

// Fungsi untuk menghitung jarak ke solusi ideal
function calculateDistance($matrix, $idealSolution)
{
    $distances = [];
    foreach ($matrix as $i => $row) {
        $dPositive = 0;
        $dNegative = 0;
        foreach ($row as $key => $value) {
            $dPositive += pow($value - $idealSolution[0][$key], 2);
            $dNegative += pow($value - $idealSolution[1][$key], 2);
        }
        $distances[$i] = [
            'positive' => sqrt($dPositive),
            'negative' => sqrt($dNegative)
        ];
    }
    return $distances;
}

// Fungsi untuk menghitung skor preferensi
function calculatePreference($distances)
{
    $preferences = [];
    foreach ($distances as $i => $row) {
        $preferences[$i] = $row['negative'] / ($row['positive'] + $row['negative']);
    }
    return $preferences;
}

// Ambil data bobot dari database
$bobotQuery = $conn->query("SELECT * FROM tbl_kriteria");
$criteria = [];
$weights = [];
while ($row = $bobotQuery->fetch_assoc()) {
    $criteria[$row['kode_kriteria']] = $row['jenis'];
    $weights[$row['kode_kriteria']] = $row['bobot'];
}

// Ambil data alternatif dari tbl_alternatif
$alternatifQuery = $conn->query("SELECT * FROM tbl_alternatif");
$alternatif = [];
while ($row = $alternatifQuery->fetch_assoc()) {
    $alternatif[$row['kode_alternatif']] = $row['nama_alternatif']; 
}

// Ambil data dari tbl_data
$dataQuery = $conn->query("SELECT * FROM tbl_data");
$data = [];
while ($row = $dataQuery->fetch_assoc()) {
    $data[] = $row;
}

// Ambil nama kolom dari tbl_data (kecuali kolom id dan nama_objek_wisata)
$kolomQuery = $conn->query("SHOW COLUMNS FROM tbl_data");
$namaKolom = [];
while ($row = $kolomQuery->fetch_assoc()) {
    // Abaikan kolom 'id', 'nama_objek_wisata', dan kolom bertipe 'varchar'
    if ($row['Field'] != 'id' && $row['Field'] != 'nama_objek_wisata' && strpos($row['Type'], 'varchar') === false) {
        $namaKolom[] = $row['Field'];
    }
}

// Siapkan matriks untuk perhitungan
$matrix = [];
foreach ($alternatif as $kodeAlternatif => $namaAlternatif) {
    $query = "SELECT * FROM tbl_data WHERE nama_objek_wisata = '$namaAlternatif'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    $matrix[$kodeAlternatif] = []; // Gunakan $kodeAlternatif sebagai key
    foreach ($namaKolom as $j => $kolom) {
        $kodeKriteria = 'C' . ($j + 1);
        $matrix[$kodeAlternatif][$kodeKriteria] = $row[$kolom];
    }
}

// var_dump($matrix); // Untuk debugging

// Langkah 1: Normalisasi Matriks
$normalizedMatrix = normalizeMatrix($matrix, $criteria);

// Langkah 2: Matriks Terbobot
$weightedMatrix = weightedMatrix($normalizedMatrix, $weights);

// Langkah 3: Solusi Ideal Positif dan Negatif
list($idealPositive, $idealNegative) = idealSolution($weightedMatrix, $criteria);

// Langkah 4: Jarak ke Solusi Ideal
$distances = calculateDistance($weightedMatrix, [$idealPositive, $idealNegative]);

// Langkah 5: Skor Preferensi
$preferences = calculatePreference($distances);

// Urutkan skor preferensi secara descending
arsort($preferences);

// Simpan hasil ke tbl_hasil
$conn->query("TRUNCATE TABLE tbl_hasil"); // Hapus semua data di tbl_hasil
$rank = 1; // Inisialisasi peringkat
foreach ($preferences as $kodeAlternatif => $score) { // Gunakan $kodeAlternatif sebagai key
    // $namaAlternatif = $alternatif[$kodeAlternatif]; // Tidak perlu lagi karena tidak ada kolom nama_alternatif di tbl_hasil

    // Query INSERT yang benar
    $conn->query("INSERT INTO tbl_hasil (kode_alternatif, total_nilai, rank) VALUES ('$kodeAlternatif', '$score', '$rank')"); 
    $rank++;
}

// Tampilkan hasil perhitungan
echo "<div class='container mt-5'>";
echo "<h2>PROSES PERHITUNGAN TOPSIS</h2>";
echo "<hr>";
echo "<br>";

// Tampilkan Normalisasi Matriks
echo "<h4>Normalisasi Matriks</h4>";
echo "<table class='table table-bordered'>";
echo "<thead><tr><th>Alternatif</th>";
foreach ($namaKolom as $j => $kolom) {
    $kodeKriteria = 'C' . ($j + 1);
    echo "<th>$kodeKriteria</th>";
}
echo "</tr></thead><tbody>";
foreach ($normalizedMatrix as $kodeAlternatif => $row) {
    echo "<tr><td>$kodeAlternatif</td>"; // Tampilkan $kodeAlternatif
    foreach ($row as $key => $value) {
        echo "<td>" . number_format($value, 4) . "</td>";
    }
    echo "</tr>";
}
echo "</tbody></table>";

// Tampilkan Matriks Terbobot
echo "<h4>Matriks Terbobot</h4>";
echo "<table class='table table-bordered'>";
echo "<thead><tr><th>Alternatif</th>";
foreach ($namaKolom as $j => $kolom) {
    $kodeKriteria = 'C' . ($j + 1);
    echo "<th>$kodeKriteria</th>";
}
echo "</tr></thead><tbody>";
foreach ($weightedMatrix as $kodeAlternatif => $row) {
    echo "<tr><td>$kodeAlternatif</td>"; // Tampilkan $kodeAlternatif
    foreach ($row as $key => $value) {
        echo "<td>" . number_format($value, 4) . "</td>";
    }
    echo "</tr>";
}
echo "</tbody></table>";

// Tampilkan Solusi Ideal
echo "<h4>Solusi Ideal</h4>";
echo "<table class='table table-bordered'>";
echo "<thead><tr><th>Solusi</th>";
foreach ($namaKolom as $j => $kolom) {
    $kodeKriteria = 'C' . ($j + 1);
    echo "<th>$kodeKriteria</th>";
}
echo "</tr></thead><tbody>";

echo "<tr><td>Ideal Positif</td>";
foreach ($idealPositive as $key => $value) {
    echo "<td>" . number_format($value, 4) . "</td>";
}
echo "</tr>";

echo "<tr><td>Ideal Negatif</td>";
foreach ($idealNegative as $key => $value) {
    echo "<td>" . number_format($value, 4) . "</td>";
}
echo "</tr>";

echo "</tbody></table>";

// Tampilkan Jarak ke Solusi Ideal
echo "<h4>Jarak ke Solusi Ideal</h4>";
echo "<table class='table table-bordered'>";
echo "<thead><tr><th>Alternatif</th><th>S+</th><th>S-</th></tr></thead><tbody>";
foreach ($distances as $kodeAlternatif => $distance) {
    echo "<tr><td>$kodeAlternatif</td><td>" . number_format($distance['positive'], 4) . "</td><td>" . number_format($distance['negative'], 4) . "</td></tr>";
}
echo "</tbody></table>";

// Tampilkan Skor Preferensi dan Hasil Akhir
echo "<h4>Hasil Akhir</h4>";
echo "<table class='table table-bordered'>";
echo "<thead><tr><th>Alternatif</th><th>Total Nilai C+</th><th>Rank</th></tr></thead><tbody>";
foreach ($preferences as $kodeAlternatif => $score) {
    $rank = array_search($score, array_unique(array_values($preferences))) + 1;
    echo "<tr><td>$kodeAlternatif</td><td>" . number_format($score, 4) . "</td><td>$rank</td></tr>";
}
echo "</tbody></table>";

echo "</div>";

include "footer.php"; ?>
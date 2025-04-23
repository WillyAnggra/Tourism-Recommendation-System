<?php
include "header.php";
include '../koneksi/config.php';

// Ambil filter jenis wisata jika ada
$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';

// Query untuk mendapatkan daftar jenis wisata
$queryJenis = "SELECT DISTINCT jenis FROM tbl_data";
$resultJenis = $conn->query($queryJenis);

// Query untuk menampilkan objek wisata berdasarkan ranking dengan filter jenis
$sql = "SELECT d.id, d.gambar, d.nama_objek_wisata, d.harga_tiket, d.jarak, d.jenis 
        FROM tbl_hasil h
        JOIN tbl_alternatif a ON h.kode_alternatif = a.kode_alternatif
        JOIN tbl_data d ON a.nama_alternatif = d.nama_objek_wisata";

if (!empty($jenis)) {
    $sql .= " WHERE d.jenis = ?";
}

$sql .= " ORDER BY h.rank ASC";

$stmt = $conn->prepare($sql);
if (!empty($jenis)) {
    $stmt->bind_param("s", $jenis);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Objek Wisata</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .objek-wisata-card img {
            height: 200px;
            object-fit: cover;
        }

        .objek-wisata-list img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .nav-active {
            background-color: #2563EB;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container mx-auto mt-5">
    <h2 class="mb-4 text-2xl font-bold text-center">Rekomendasi Objek Wisata</h2>

    <!-- Filter Jenis Wisata -->
    <nav class="mb-4 flex space-x-4 justify-center">
        <a href="hasil.php" class="px-4 py-2 rounded-lg <?= empty($jenis) ? 'nav-active' : 'bg-gray-300' ?>">Semua Jenis</a>
        <?php while ($rowJenis = $resultJenis->fetch_assoc()) : ?>
            <a href="hasil.php?jenis=<?= urlencode($rowJenis['jenis']) ?>" 
               class="px-4 py-2 rounded-lg <?= ($jenis === $rowJenis['jenis']) ? 'nav-active' : 'bg-gray-300' ?>">
               <?= htmlspecialchars($rowJenis['jenis']) ?>
            </a>
        <?php endwhile; ?>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 objek-wisata-list">
        <?php if ($result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="objek-wisata">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="../assets/images/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_objek_wisata']) ?>">
                        <div class="p-4">
                            <h5 class="text-lg font-bold mb-2"><?= htmlspecialchars($row['nama_objek_wisata']) ?></h5>
                            <p class="text-gray-700 text-base">Harga Tiket: Rp <?= number_format($row['harga_tiket'], 0, ',', '.') ?></p>
                            <p class="text-gray-700 text-base">Jarak: <?= htmlspecialchars($row['jarak']) ?> km</p>
                            <a href="detail.php?id=<?= $row['id'] ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p class="text-center">Data objek wisata tidak tersedia.</p>
        <?php endif; ?>
    </div>
</div>

<?php include "footer.php"; ?>

</body>
</html>

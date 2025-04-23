<?php
include '../koneksi/config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID tidak valid.";
    exit();
}

$id = intval($_GET['id']);

// Query untuk mengambil detail objek wisata berdasarkan ID dari `tbl_data`
$sql = "SELECT * FROM tbl_data WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo "Data tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Objek Wisata</title>
    
    <style>
        .objek-wisata-card img {
            max-width: 100%;
            max-height: 600px;
            display: block;
            margin: 0 auto;
        }
    </style>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include "header.php"; ?>

<div class="container mx-auto mt-5">
    <h2 class="mb-4 text-2xl font-bold text-center">Detail Objek Wisata</h2>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="objek-wisata-card">
            <img src="../assets/images/<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['nama_objek_wisata']); ?>">
        </div>
        <div class="p-4">
            <h5 class="text-lg font-bold mb-2"><?php echo htmlspecialchars($row['nama_objek_wisata']); ?></h5>
            <p class='text-gray-700 text-base'>Harga Tiket: Rp <?php echo number_format($row['harga_tiket'], 0, ',', '.'); ?></p>
            <p class='text-gray-700 text-base'>Jarak: <?php echo htmlspecialchars($row['jarak']); ?> km</p>
            <p class='text-gray-700 text-base'>Jumlah Wisatawan: <?php echo htmlspecialchars($row['jumlah_wisatawan']); ?> Orang</p>
            <p class='text-gray-700 text-base'>Penjelasan: <?php echo nl2br(htmlspecialchars($row['penjelasan'])); ?></p>

            <a href="<?php echo htmlspecialchars($row['gmaps']); ?>" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 inline-flex items-center">
                <i class="fas fa-map-marker-alt mr-2"></i> Lihat Peta
            </a>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

</body>
</html>

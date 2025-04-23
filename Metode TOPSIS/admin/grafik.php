<?php
include '../koneksi/config.php';
include "header.php";

// Query untuk mengambil data yang diperlukan dan mengurutkan berdasarkan total_nilai (DESC)
$query = "
    SELECT 
        tbl_hasil.total_nilai, 
        tbl_alternatif.nama_alternatif, 
        tbl_data.harga_tiket, 
        tbl_data.jumlah_wisatawan, 
        tbl_data.jarak 
    FROM tbl_hasil
    JOIN tbl_alternatif ON tbl_hasil.kode_alternatif = tbl_alternatif.kode_alternatif
    JOIN tbl_data ON tbl_alternatif.nama_alternatif = tbl_data.nama_objek_wisata
    ORDER BY tbl_hasil.total_nilai DESC
";

$result = mysqli_query($conn, $query);

$alternatif = [];
$total_nilai = [];
$tooltip_data = [];

// Mengisi data dari hasil query
while ($row = mysqli_fetch_assoc($result)) {
    $alternatif[] = $row['nama_alternatif'];
    // Membatasi total_nilai menjadi 4 angka di belakang koma
    $nilai = round($row['total_nilai'], 4);
    $total_nilai[] = $nilai;
    $tooltip_data[] = "Total Nilai: " . $nilai . 
                     "\nHarga Tiket: Rp" . number_format($row['harga_tiket']) . 
                     "\nJumlah Wisatawan: " . $row['jumlah_wisatawan'] . " orang" . 
                     "\nJarak: " . $row['jarak'] . " km";
}
?>

<div class="container">
    <h2>Grafik Total Nilai Objek Wisata</h2>
    <canvas id="grafikWisata"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('grafikWisata').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($alternatif); ?>,
            datasets: [{
                label: 'Total Nilai',
                data: <?php echo json_encode($total_nilai); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var index = context.dataIndex;
                            var tooltipInfo = <?php echo json_encode($tooltip_data); ?>;
                            return tooltipInfo[index].split("\n");
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include "footer.php"; ?>

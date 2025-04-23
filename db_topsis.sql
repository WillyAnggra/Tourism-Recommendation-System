-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Feb 2025 pada 18.20
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_topsis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id` int(11) NOT NULL,
  `kode_alternatif` varchar(5) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id`, `kode_alternatif`, `nama_alternatif`) VALUES
(1, 'A1', 'Air Terjun Serintik Hujan Panas'),
(2, 'A2', 'Danau Depati Empat'),
(3, 'A3', 'Air Terjun Dukun Betuah'),
(4, 'A4', 'Danau Telaga Biru'),
(5, 'A5', 'Taman Batu'),
(6, 'A6', 'Hutan Adat Guguk'),
(7, 'A7', 'Hutan Adat Serampas Rantau Kermas'),
(8, 'A8', 'Rumah Tuo Rantau Panjang'),
(9, 'A9', 'Batu Silindrik Situs Peratin Tua'),
(10, 'A10', 'Batu Bertulis Karang Berahi'),
(11, 'A11', 'Teluk Wang'),
(12, 'A12', 'Mata Air Panas Grao Sakti'),
(13, 'A13', 'Serpih Hitam Mengkarang Berfosil'),
(14, 'A14', 'Water Boom Family Abadi'),
(15, 'A15', 'Waterpark Sikumbang'),
(16, 'A16', 'Embung Rejo Sari Tabir Ilir'),
(17, 'A17', 'Water Boom Sumber Agung'),
(18, 'A18', 'Embung Hitam Ulu (GreenHill)'),
(19, 'A19', 'Embung Pinang Merah'),
(20, 'A20', 'Arung Jeram Dua Sahabat'),
(21, 'A21', 'Arung Jeram Air Batu Rivers'),
(22, 'A22', 'Wisata Pemandian Pelakar Jaya'),
(23, 'A23', 'Tubbing Desa Bedeng Rejo'),
(24, 'A24', 'Tubbing Desa Pulau Tengah'),
(25, 'A25', 'Camping Ground Villa'),
(26, 'A26', 'Taman Bunga Trans Garden C2'),
(27, 'A27', 'Taman Indah Lestari'),
(28, 'A28', 'Jeruk Girga Ma. Madras'),
(29, 'A29', 'Tanjung Menanti'),
(30, 'A30', 'Lubuk Pelayang'),
(31, 'A31', 'Taman Impian'),
(32, 'A32', 'Surti Terawang Lidah'),
(33, 'A33', 'Gading Garden'),
(34, 'A34', 'Agro Lembah Mentenang'),
(35, 'A35', 'Pulau Batu'),
(36, 'A36', 'Taman Geopark'),
(37, 'A37', 'Kampung Kopi Madras Berseri'),
(38, 'A38', 'Gunung Masurai'),
(39, 'A39', 'Air Terjun Telun Kambing'),
(40, 'A40', 'Arboretum Rio Alif'),
(41, 'A41', 'Bukit Tiung'),
(42, 'A42', 'Goa Tiangko'),
(43, 'A43', 'Danau Pauh'),
(44, 'A44', 'Muara Karing'),
(45, 'A45', 'Air Terjun Sigerincing'),
(46, 'A46', 'Pusat Informasi Geopark');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_data`
--

CREATE TABLE `tbl_data` (
  `id` int(11) NOT NULL,
  `nama_objek_wisata` varchar(50) NOT NULL,
  `harga_tiket` int(11) NOT NULL,
  `fasilitas` int(11) NOT NULL,
  `jarak` float NOT NULL,
  `jumlah_wisatawan` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `penjelasan` varchar(255) NOT NULL,
  `gmaps` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_data`
--

INSERT INTO `tbl_data` (`id`, `nama_objek_wisata`, `harga_tiket`, `fasilitas`, `jarak`, `jumlah_wisatawan`, `gambar`, `jenis`, `penjelasan`, `gmaps`) VALUES
(1, 'Air Terjun Serintik Hujan Panas', 5000, 5, 67.4, 5265, '1.jpg', 'Tempat Wisata Tambahan', 'Air terjun unik dengan air hangat, terbentuk dari batuan Andesit-Basalt dan Ignimbrit hasil letusan formasi Kaldera Masurai. Terbentuk akibat aktivitas tektonik yang menyebabkan patahan dan membentuk Kekar Kolom.', ''),
(2, 'Danau Depati Empat', 0, 4, 120, 2756, '2.jpg', 'Tempat Wisata Tambahan', 'Danau tenang di ketinggian 1.200 mdpl, menawarkan ketenangan dan pemandangan indah. Terbentuk akibat aktivitas tektonik yang menghasilkan sesar. Batuan dasarnya adalah Granitoid Langkup yang berumur Pliosen.', ''),
(3, 'Air Terjun Dukun Betuah', 0, 3, 113, 3459, '3.jpg', 'Tempat Wisata Tambahan', 'Air terjun di dataran tinggi, dengan batuan dasar skoria basalt hasil erupsi pra-kaldera Gunung Masurai. Terbentuk dari erupsi pra-kaldera, diikuti lapisan tuf pasiran, dan endapan lava Andesit-Basalt.', ''),
(4, 'Danau Telaga Biru', 0, 1, 112, 3127, '4.jpg', 'Tempat Wisata Tambahan', 'Kawah letusan freatik kecil di dalam Kaldera Masurai dengan air berwarna biru. Terbentuk dari letusan freatik kecil, dengan dasar yang kedap air.', ''),
(5, 'Taman Batu', 10000, 5, 74, 13659, '5.jpg', 'Tempat Wisata Tambahan', 'Taman dengan formasi bebatuan unik, hasil dari proses geologi selama jutaan tahun. Terbentuk dari proses alam seperti pelapukan dan erosi yang membentuk batuan menjadi berbagai bentuk menarik.', ''),
(6, 'Hutan Adat Guguk', 5000, 2, 12.1, 783, '6.jpg', 'Tempat Wisata Tambahan', 'Hutan adat seluas ± 63.000 hektar, melindungi harimau, tapir, dan rusa. Dijaga dan dilestarikan oleh masyarakat adat setempat secara turun-temurun.', ''),
(7, 'Hutan Adat Serampas Rantau Kermas', 0, 3, 130, 1396, '7.jpg', 'Tempat Wisata Tambahan', 'Hutan adat yang menjadi rumah bagi masyarakat adat Serampas, dengan flora dan fauna yang beragam. Telah dijaga oleh masyarakat adat Serampas selama beberapa generasi.', ''),
(8, 'Rumah Tuo Rantau Panjang', 0, 1, 20, 1420, '', 'Tempat Wisata Tambahan', 'Perkampungan dengan bangunan tua berusia sekitar 400 tahun, dihuni oleh keturunan ke-14. Merupakan salah satu perkampungan tertua di Kabupaten Merangin.', ''),
(9, 'Batu Silindrik Situs Peratin Tua', 0, 0, 93, 856, '', 'Tempat Wisata Tambahan', 'Batu silindrik berukuran 4,38 x 1,125 meter, terbuat dari Ignimbrit hasil letusan Kaldera Gunung Masurai. Diperkirakan merupakan peninggalan megalitikum.', ''),
(10, 'Batu Bertulis Karang Berahi', 0, 0, 37.6, 637, '', 'Tempat Wisata Tambahan', 'Prasasti dengan tulisan Sangsekerta Bahasa Melayu Kuno, dibuat sekitar tahun 680-an. Berisi tentang kutukan bagi yang tidak setia kepada raja.', ''),
(11, 'Teluk Wang', 5000, 5, 15.5, 3487, '', 'Tempat Wisata Tambahan', 'Teluk dengan pemandangan indah, airnya tenang dan jernih. Terbentuk oleh proses geologi selama jutaan tahun, dulunya merupakan bagian dari dasar laut.', ''),
(12, 'Mata Air Panas Grao Sakti', 0, 0, 130, 254, '', 'Tempat Wisata Tambahan', 'Semburan air panas yang mengeluarkan asap belerang, hasil aktivitas magma. Terbentuk akibat aktivitas vulkanik di daerah tersebut.', ''),
(13, 'Serpih Hitam Mengkarang Berfosil', 0, 4, 20.1, 962, '', 'Tempat Wisata Tambahan', 'Formasi batuan yang mengandung fosil-fosil laut seperti brakhiopoda dan krinoid. Merupakan bagian dari Formasi Mengkarang pada zaman Paleozoikum.', ''),
(14, 'Water Boom Family Abadi', 25000, 5, 14, 64, '14.jpg', 'Wisata Air', 'Wahana permainan air untuk keluarga, dengan seluncuran dan kolam renang. Dibangun untuk memenuhi kebutuhan rekreasi keluarga di Kabupaten Merangin.', ''),
(15, 'Waterpark Sikumbang', 25000, 5, 1.5, 58, '15.jpg', 'Wisata Air', 'Taman rekreasi air dengan wahana permainan modern. Dibangun sebagai tempat wisata air yang menawarkan keseruan dan hiburan.', ''),
(16, 'Embung Rejo Sari Tabir Ilir', 7000, 0, 46, 236, '16.jpeg', 'Wisata Air', 'Waduk sebagai sumber pengairan dan pengendali banjir, juga menawarkan pemandangan alam. Dibangun untuk mendukung pertanian dan mencegah banjir.', ''),
(17, 'Water Boom Sumber Agung', 25000, 5, 8, 2541, '17.jpg', 'Wisata Air', 'Kolam renang dan wahana permainan air untuk keluarga. Dibangun untuk menyediakan tempat rekreasi air yang terjangkau.', ''),
(18, 'Embung Hitam Ulu (GreenHill)', 10000, 3, 24, 7970, '', 'Wisata Air', 'Waduk dengan pemandangan perbukitan hijau yang asri. Dibangun untuk menampung air hujan dan berfungsi sebagai irigasi.', ''),
(19, 'Embung Pinang Merah', 5000, 2, 36, 0, '', 'Wisata Air', 'Waduk dengan air yang tenang dan jernih, dikelilingi pepohonan rindang. Dibangun untuk menjaga ketersediaan air.', ''),
(20, 'Arung Jeram Dua Sahabat', 700000, 2, 29.7, 1315, '20.jpg', 'Wisata Air', 'Wisata arung jeram yang menantang adrenalin, menyusuri sungai dengan jeram. Dikembangkan sebagai objek wisata minat khusus.', ''),
(21, 'Arung Jeram Air Batu Rivers', 700000, 2, 29, 2643, '21.jpg', 'Wisata Air', 'Wisata arung jeram di sungai dengan bebatuan besar dan jeram. Rute arung jeram yang baru dibuka, menawarkan pengalaman berbeda.', ''),
(22, 'Wisata Pemandian Pelakar Jaya', 20000, 5, 15, 1672, '22.jpg', 'Wisata Air', 'Pemandian umum dengan sumber air alami yang segar. Telah lama menjadi tempat pemandian favorit masyarakat.', ''),
(23, 'Tubbing Desa Bedeng Rejo', 5000, 2, 102, 0, '', 'Wisata Air', '', ''),
(24, 'Tubbing Desa Pulau Tengah', 5000, 2, 128, 1277, '', 'Wisata Air', '', ''),
(25, 'Camping Ground Villa', 60000, 5, 20, 1863, '25.jpeg', 'Wisata Air', 'Tempat berkemah yang dilengkapi dengan fasilitas villa. Dibangun untuk mengakomodasi wisatawan yang ingin menikmati alam.', ''),
(26, 'Taman Bunga Trans Garden C2', 10000, 2, 16, 0, '26.jpg', 'Taman', 'Taman dengan berbagai jenis bunga yang indah, cocok untuk berfoto. Dirancang sebagai tempat wisata yang menawarkan keindahan.', ''),
(27, 'Taman Indah Lestari', 15000, 3, 19, 0, '27.jpg', 'Taman', 'Taman yang tertata rapi dengan berbagai fasilitas rekreasi. Dibangun untuk menyediakan ruang terbuka hijau.', ''),
(28, 'Jeruk Girga Ma. Madras', 0, 2, 138, 5005, '28.jpg', 'Taman', 'Kebun jeruk dengan pemandangan alam yang indah. Dikembangkan sebagai agrowisata yang menawarkan pengalaman memetik jeruk.', ''),
(29, 'Tanjung Menanti', 0, 0, 12, 0, '', 'Taman', 'Tanjung dengan pemandangan laut lepas. Terbentuk oleh proses erosi dan abrasi air laut selama jutaan tahun.', ''),
(30, 'Lubuk Pelayang', 15000, 5, 7, 24, '', 'Taman', 'Kolam alami dengan air yang jernih dan segar, dikelilingi tebing. Terbentuk dari proses geologi yang menciptakan cekungan.', ''),
(31, 'Taman Impian', 15000, 2, 21, 0, '31.jpg', 'Taman', 'Taman hiburan dengan wahana permainan untuk anak-anak dan dewasa. Dibangun untuk menyediakan tempat rekreasi keluarga.', ''),
(32, 'Surti Terawang Lidah', 0, 1, 5, 0, '', 'Taman', 'Formasi batuan unik yang menyerupai lidah manusia. Terbentuk dari proses pelapukan dan erosi batuan.', ''),
(33, 'Gading Garden', 5000, 4, 25, 0, '', 'Taman', 'Taman yang dipenuhi dengan tanaman hias dan bunga-bunga. Dirancang sebagai tempat rekreasi yang asri.', ''),
(34, 'Agro Lembah Mentenang', 0, 4, 48, 5210, '', 'Taman', 'Kawasan pertanian dengan pemandangan sawah. Merupakan lahan pertanian produktif yang dikelola oleh masyarakat.', ''),
(35, 'Pulau Batu', 10000, 5, 74, 20, '35.jpg', 'Taman', 'Pulau kecil dengan bebatuan besar dan formasi unik. Terbentuk dari aktivitas vulkanik dan proses geologi.', ''),
(36, 'Taman Geopark', 5000, 5, 60, 1015, '', 'Taman', 'Taman yang memamerkan batuan dan fosil. Dikembangkan sebagai pusat edukasi tentang geologi.', ''),
(37, 'Kampung Kopi Madras Berseri', 0, 1, 138, 2485, '', 'Taman', 'Desa yang terkenal dengan produksi kopi robusta. Masyarakat telah lama membudidayakan kopi secara tradisional.', ''),
(38, 'Gunung Masurai', 10000, 3, 110, 172, '38.jpg', 'Gunung', 'Gunung berapi aktif dengan ketinggian 2.985 mdpl. Memiliki sejarah letusan yang membentuk kaldera dan kawah.', ''),
(39, 'Air Terjun Telun Kambing', 0, 0, 130, 607, '39.jpg', 'Gunung', 'Air terjun yang dikelilingi tebing dan hutan lebat. Terbentuk dari patahan geologis dan erosi air sungai.', ''),
(40, 'Arboretum Rio Alif', 10000, 5, 12.1, 7496, '', 'Dikelola Pemerintah', 'Taman hutan raya dengan koleksi tumbuhan. Dikembangkan sebagai pusat konservasi dan edukasi.', ''),
(41, 'Bukit Tiung', 10000, 4, 1, 2465, '41.jpg', 'Dikelola Pemerintah', 'Bukit dengan pemandangan indah, cocok untuk hiking. Terbentuk dari proses geologi pengangkatan kerak bumi.', ''),
(42, 'Goa Tiangko', 10000, 1, 50, 258, '42.jpg', 'Dikelola Pemerintah', 'Gua dengan stalaktit dan stalakmit, memiliki nilai arkeologi prasejarah. Pernah menjadi tempat tinggal manusia purba.', ''),
(43, 'Danau Pauh', 10000, 5, 110, 17, '43.jpg', 'Dikelola Pemerintah', 'Danau vulkanik yang terbentuk akibat aktivitas Gunung Masurai Purba. Terbentuk dari letusan gunung api.', ''),
(44, 'Muara Karing', 10000, 3, 23, 16, '44.jpg', 'Dikelola Pemerintah', 'Muara sungai dengan pemandangan indah, fosil daun di sekitar sungai. Sungai Karing bermuara ke Sungai Merangin, di muaranya terdapat air terjun.', ''),
(45, 'Air Terjun Sigerincing', 10000, 5, 80, 5350, '45.jpg', 'Dikelola Pemerintah', 'Air terjun di Sungai Siau, terbentuk dari batuan hasil erupsi Gunung Masurai pra-kaldera. Terbentuk akibat aktivitas tektonik.', ''),
(46, 'Pusat Informasi Geopark', 10000, 5, 29.7, 1076, '', 'Dikelola Pemerintah', 'Gedung yang menyediakan informasi tentang Geopark Merangin. Dibangun untuk edukasi dan informasi pengunjung.', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hasil`
--

CREATE TABLE `tbl_hasil` (
  `id` int(11) NOT NULL,
  `kode_alternatif` varchar(5) NOT NULL,
  `total_nilai` float NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_hasil`
--

INSERT INTO `tbl_hasil` (`id`, `kode_alternatif`, `total_nilai`, `rank`) VALUES
(1, 'A21', 0.669667, 1),
(2, 'A20', 0.650454, 2),
(3, 'A5', 0.360087, 3),
(4, 'A28', 0.264095, 4),
(5, 'A37', 0.236604, 5),
(6, 'A18', 0.232604, 6),
(7, 'A40', 0.227718, 7),
(8, 'A2', 0.225403, 8),
(9, 'A45', 0.224309, 9),
(10, 'A7', 0.22342, 10),
(11, 'A3', 0.220604, 11),
(12, 'A24', 0.218452, 12),
(13, 'A39', 0.213929, 13),
(14, 'A12', 0.212638, 14),
(15, 'A1', 0.21069, 15),
(16, 'A4', 0.210604, 16),
(17, 'A43', 0.203402, 17),
(18, 'A38', 0.193916, 18),
(19, 'A34', 0.187303, 19),
(20, 'A23', 0.177845, 20),
(21, 'A9', 0.16358, 21),
(22, 'A35', 0.158176, 22),
(23, 'A36', 0.144405, 23),
(24, 'A11', 0.142187, 24),
(25, 'A25', 0.138976, 25),
(26, 'A17', 0.127221, 26),
(27, 'A46', 0.114426, 27),
(28, 'A22', 0.114387, 28),
(29, 'A41', 0.107848, 29),
(30, 'A14', 0.102909, 30),
(31, 'A15', 0.0996447, 31),
(32, 'A30', 0.0971774, 32),
(33, 'A42', 0.0954265, 33),
(34, 'A13', 0.0897827, 34),
(35, 'A33', 0.0889305, 35),
(36, 'A16', 0.0858361, 36),
(37, 'A19', 0.077213, 37),
(38, 'A44', 0.0730665, 38),
(39, 'A10', 0.0725972, 39),
(40, 'A27', 0.0705667, 40),
(41, 'A8', 0.0611031, 41),
(42, 'A31', 0.0584074, 42),
(43, 'A6', 0.0520166, 43),
(44, 'A26', 0.0507773, 44),
(45, 'A29', 0.0216974, 45),
(46, 'A32', 0.021664, 46);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(5) NOT NULL,
  `nama_kriteria` varchar(25) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id`, `kode_kriteria`, `nama_kriteria`, `bobot`) VALUES
(1, 'C1', 'Harga Tiket', 5),
(2, 'C2', 'Fasilitas', 2),
(3, 'C3', 'Jarak', 4),
(4, 'C4', 'Jumlah Wisatawan', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `email`, `nohp`, `password`, `level`) VALUES
(1, 'admin', 'admin@gmail.com', '0808', 'admin', 'admin_level'),
(2, 'user', 'user@gmail.com', '0808', 'user', 'user_level');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_data`
--
ALTER TABLE `tbl_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tbl_data`
--
ALTER TABLE `tbl_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

<?php
include "../koneksi/config.php";

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'add') {
        $nama_objek_wisata = $_POST['nama_objek_wisata'];
        $harga_tiket        = $_POST['harga_tiket'];
        $fasilitas         = $_POST['fasilitas'];
        $jarak             = $_POST['jarak'];
        $jumlah_wisatawan  = $_POST['jumlah_wisatawan'];
        $jenis             = $_POST['jenis']; // Mengambil jenis dari elemen <select>
        $penjelasan        = $_POST['penjelasan'];
        $gmaps             = $_POST['gmaps'];

        // Handle upload gambar
        $gambar_name = $_FILES['gambar']['name'];
        $gambar_tmp  = $_FILES['gambar']['tmp_name'];
        $gambar_ext  = strtolower(pathinfo($gambar_name, PATHINFO_EXTENSION));
        $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($gambar_ext, $allowed_exts)) {
            $new_gambar_name = uniqid('', true). '.'. $gambar_ext;
            $gambar_path = '../assets/images/'. $new_gambar_name;
            move_uploaded_file($gambar_tmp, $gambar_path);

            // Simpan data ke database
            mysqli_query($conn, "INSERT INTO tbl_data(nama_objek_wisata, harga_tiket, fasilitas, jarak, jumlah_wisatawan, gambar, jenis, penjelasan, gmaps) 
                                        VALUES ('$nama_objek_wisata', '$harga_tiket', '$fasilitas', '$jarak', '$jumlah_wisatawan', '$new_gambar_name', '$jenis', '$penjelasan', '$gmaps')");

            header("location:data.php");
        } else {
            echo "Format gambar tidak valid.";
        }
    }
}

include "header.php";?>

<h2 class="mb-4">DATA OBJEK WISATA/ Add Data Objek Wisata</h2>
<hr>
<div class="shadow p-5">
    <form action="data-add.php?aksi=add" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Objek Wisata</label>
            <input type="text" name="nama_objek_wisata" class="txt form-control" required>
        </div>

        <div class="form-group">
            <label>Harga Tiket</label>
            <input type="text" name="harga_tiket" class="txt form-control" required>
        </div>
        <div class="form-group">
            <label>Fasilitas</label>
            <input type="text" name="fasilitas" class="txt form-control" required>
        </div>
        <div class="form-group">
            <label>Jarak dari Ibu Kota Kab.</label>
            <input type="text" name="jarak" class="txt form-control" required>
        </div>
        <div class="form-group">
            <label>Jumlah Wisatawan</label>
            <input type="text" name="jumlah_wisatawan" class="txt form-control" required>
        </div>

        <div class="form-group">
            <label>Jenis</label>
            <select name="jenis" class="txt form-control" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="Wisata Air">Wisata Air</option>
                <option value="Taman">Taman</option>
                <option value="Gunung">Gunung</option>
                <option value="Dikelola Pemerintah">Dikelola Pemerintah</option>
                <option value="Wisata Lain">Wisata Lain</option>
            </select>
        </div>

        <div class="form-group">
            <label>Penjelasan</label>
            <textarea name="penjelasan" class="txt form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>Link Google Maps</label>
            <input type="text" name="gmaps" class="txt form-control" required>
        </div>

        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control-file" required>
        </div>

        <input type="submit" value="Simpan" class="btn btn-dark">
        <a href="data.php" class="btn btn-danger text-light">Batal</a>
    </form>
</div>
</div>
</div>
</div>
<?php
include "../koneksi/config.php";

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'update') {
        $id                 = $_POST['id'];
        $nama_objek_wisata = $_POST['nama_objek_wisata'];
        $harga_tiket        = $_POST['harga_tiket'];
        $fasilitas         = $_POST['fasilitas'];
        $jarak             = $_POST['jarak'];
        $jumlah_wisatawan  = $_POST['jumlah_wisatawan'];
        $jenis             = $_POST['jenis'];
        $penjelasan        = $_POST['penjelasan'];
        $gmaps             = $_POST['gmaps'];

        // Handle upload gambar
        if ($_FILES['gambar']['name']) { // Cek apakah ada file gambar yang diupload
            $gambar_name = $_FILES['gambar']['name'];
            $gambar_tmp  = $_FILES['gambar']['tmp_name'];
            $gambar_ext  = strtolower(pathinfo($gambar_name, PATHINFO_EXTENSION));
            $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($gambar_ext, $allowed_exts)) {
                $new_gambar_name = uniqid('', true). '.'. $gambar_ext;
                $gambar_path = '../assets/images/'. $new_gambar_name;
                move_uploaded_file($gambar_tmp, $gambar_path);

                // Hapus gambar lama jika ada
                $oldGambarQuery = mysqli_query($conn, "SELECT gambar FROM tbl_data WHERE id='$id'");
                $oldGambarData = mysqli_fetch_assoc($oldGambarQuery);
                if ($oldGambarData['gambar']) {
                    $oldGambarPath = '../assets/images/'. $oldGambarData['gambar'];
                    if (file_exists($oldGambarPath)) {
                        unlink($oldGambarPath);
                    }
                }

                // Update data di database dengan gambar baru
                mysqli_query($conn, "UPDATE tbl_data SET 
                                            nama_objek_wisata = '$nama_objek_wisata',
                                            harga_tiket        = '$harga_tiket',
                                            fasilitas         = '$fasilitas',
                                            jarak             = '$jarak',
                                            jumlah_wisatawan  = '$jumlah_wisatawan',
                                            gambar            = '$new_gambar_name',
                                            jenis             = '$jenis',
                                            penjelasan        = '$penjelasan',
                                            gmaps             = '$gmaps'
                                        WHERE id = '$id'");
            } else {
                echo "Format gambar tidak valid.";
            }
        } else {
            // Update data di database tanpa mengubah gambar
            mysqli_query($conn, "UPDATE tbl_data SET 
                                            nama_objek_wisata = '$nama_objek_wisata',
                                            harga_tiket        = '$harga_tiket',
                                            fasilitas         = '$fasilitas',
                                            jarak             = '$jarak',
                                            jumlah_wisatawan  = '$jumlah_wisatawan',
                                            jenis             = '$jenis',
                                            penjelasan        = '$penjelasan',
                                            gmaps             = '$gmaps'
                                        WHERE id = '$id'");
        }

        header("location:data.php");
    }
}

include "header.php";?>

<h2 class="mb-4">DATA OBJEK WISATA/ Update Data Objek Wisata</h2>
<hr>
<div class="shadow p-5">
    <?php
    $data = mysqli_query($conn, "SELECT * FROM tbl_data WHERE id='$_GET[id]'");
    while ($a = mysqli_fetch_array($data)) {
  ?>
        <form action="data-update.php?aksi=update" method="post" enctype="multipart/form-data">
            <input name="id" type="hidden" value="<?= $a['id']?>">
            <div class="form-group">
                <label>Nama Objek Wisata</label>
                <input type="text" name="nama_objek_wisata" class="txt form-control" required value="<?= $a['nama_objek_wisata']?>">
            </div>

            <div class="form-group">
                <label>Harga Tiket</label>
                <input type="text" name="harga_tiket" class="txt form-control" required value="<?= $a['harga_tiket']?>">
            </div>
            <div class="form-group">
                <label>Fasilitas</label>
                <input type="text" name="fasilitas" class="txt form-control" required value="<?= $a['fasilitas']?>">
            </div>
            <div class="form-group">
                <label>Jarak dari Ibu Kota Kab.</label>
                <input type="text" name="jarak" class="txt form-control" required value="<?= $a['jarak']?>">
            </div>
            <div class="form-group">
                <label>Jumlah Wisatawan</label>
                <input type="text" name="jumlah_wisatawan" class="txt form-control" required value="<?= $a['jumlah_wisatawan']?>">
            </div>

            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis" class="txt form-control" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Wisata Air" <?php if ($a['jenis'] == 'Wisata Air') echo 'selected';?>>Wisata Air</option>
                    <option value="Taman" <?php if ($a['jenis'] == 'Taman') echo 'selected';?>>Taman</option>
                    <option value="Gunung" <?php if ($a['jenis'] == 'Gunung') echo 'selected';?>>Gunung</option>
                    <option value="Dikelola Pemerintah" <?php if ($a['jenis'] == 'Dikelola Pemerintah') echo 'selected';?>>Dikelola Pemerintah</option>
                    <option value="Wisata Lain" <?php if ($a['jenis'] == 'Wisata Lain') echo 'selected';?>>Wisata Lain</option>
                </select>
            </div>

            <div class="form-group">
                <label>Penjelasan</label>
                <textarea name="penjelasan" class="txt form-control" required><?= $a['penjelasan']?></textarea>
            </div>

            <div class="form-group">
                <label>Link Google Maps</label>
                <input type="text" name="gmaps" class="txt form-control" required value="<?= $a['gmaps']?>">
            </div>

            <?php
            // Tampilkan nama file gambar yang sudah ada
            if ($a['gambar']) {
                echo "<p>Gambar saat ini: ". $a['gambar']. "</p>";
            }
          ?>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar" class="form-control-file">
                <small class="form-text text-muted">Unggah gambar baru jika Anda ingin mengganti gambar yang sudah ada.</small>
            </div>

            <input type="submit" value="Update" class="btn btn-dark">
            <a href="data.php" class="btn btn-danger text-light">Batal</a>
        </form>
    <?php }?>
</div>
</div>
</div>
</div>
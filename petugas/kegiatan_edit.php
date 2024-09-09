<?php

include ('../koneksi.php');

if (isset($_POST['submit'])) {
    $id_kegiatan = $_POST['id_kegiatan'];
    $kode_kegiatan = $_POST['kode_kegiatan'];
    $nama_kegiatan = $_POST['nama_kegiatan'];

    // Buat query update data ke database
    $sql = "UPDATE Kegiatan SET
        kode_kegiatan = ?,
        nama_kegiatan = ?
    WHERE id_kegiatan = ?";

    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param(
        "ssi", // "s" untuk string dan "i" untuk integer
        $kode_kegiatan,
        $nama_kegiatan,
        $id_kegiatan
    );

    // Jalankan query update
    if ($stmt->execute()) {
        echo "<script>alert('Data kegiatan dengan ID $kode_kegiatan berhasil diperbarui!'); window.location.href = 'kegiatan.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'kegiatan.php';</script>";
    }

    $stmt->close();
    $koneksi->close();
}
?>

<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Edit Kegiatan</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Kegiatan</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col">
            <div class="panel panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Edit Kegiatan</h3>
                </div>
                <div class="panel-body">

                    <div class="pull-right">
                        <a href="kegiatan.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <br>
                    <br>
                    <form action="kegiatan_edit.php" method="post">
                        <?php

                        include ('../koneksi.php');
                        $id_kegiatan = $_GET['id'];

                        // Query untuk mendapatkan data kegiatan berdasarkan ID
                        $sql = "SELECT * FROM Kegiatan WHERE id_kegiatan = ?";
                        $stmt = $koneksi->prepare($sql);
                        $stmt->bind_param("i", $id_kegiatan);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Cek apakah data ditemukan
                        if ($result->num_rows > 0) {
                            $kegiatan = $result->fetch_assoc();
                        } else {
                            echo "<script>alert('Data kegiatan tidak ditemukan.');</script>";
                        }

                        ?>
                        <input type="hidden" name="id_kegiatan" value="<?php echo $kegiatan['id_kegiatan']; ?>">
                        <div class="form-group">
                            <label for="kode_kegiatan">Kode Kegiatan *</label> <input readonly class="form-control"
                                type="text" id="kode_kegiatan" name="kode_kegiatan"
                                value="<?php echo $kegiatan['kode_kegiatan']; ?>" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="no_box">No. Box</label> <input class="form-control" type="text" id="no_box"
                                name="no_box" value="<?php //echo $kegiatan['no_box']; ?>">
                        </div> -->
                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan *</label> <input class="form-control" type="text"
                                id="nama_kegiatan" name="nama_kegiatan"
                                value="<?php echo $kegiatan['nama_kegiatan']; ?>" required>
                            <!-- </div>
                        <div class="form-group">
                            <label for="nama_sub_kegiatan">Nama Sub Kegiatan</label> <input class="form-control"
                                type="text" id="nama_sub_kegiatan" name="nama_sub_kegiatan"
                                value="<?php //echo $kegiatan['nama_sub_kegiatan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_pekerjaan">Nama Pekerjaan *</label> <input class="form-control" type="text"
                                id="nama_pekerjaan" name="nama_pekerjaan"
                                value="<?php //echo $kegiatan['nama_pekerjaan']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_pekerjaan">Alamat Pekerjaan *</label>
                            <textarea class=" form-control" id="alamat_pekerjaan" name="alamat_pekerjaan" required>
                                <?php //echo $kegiatan['alamat_pekerjaan']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cara_pembayaran">Cara Pembayaran *</label> <input class="form-control"
                                type="text" id="cara_pembayaran" name="cara_pembayaran"
                                value="<?php //echo $kegiatan['cara_pembayaran']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="no_kontrak">No. Kontrak</label> <input class="form-control" type="text"
                                id="no_kontrak" name="no_kontrak" value="<?php //echo $kegiatan['no_kontrak']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl_kontrak">Tanggal Kontrak</label> <input class="form-control" type="date"
                                id="tgl_kontrak" name="tgl_kontrak" value="<?php //echo $kegiatan['tgl_kontrak']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="no_basthp">No. BASTHP</label> <input class="form-control" type="text"
                                id="no_basthp" name="no_basthp" value="<?php //echo $kegiatan['no_basthp']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nilai_kontrak">Nilai Kontrak</label> <input class="form-control" type="number"
                                id="nilai_kontrak" name="nilai_kontrak"
                                value="<?php //echo $kegiatan['nilai_kontrak']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="lama_pekerjaan">Lama Pekerjaan</label>
                            <input class="form-control" type="text" id="lama_pekerjaan" name="lama_pekerjaan"
                                value="<?php //echo $kegiatan['lama_pekerjaan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai</label> <input class="form-control" type="date"
                                id="tgl_mulai" name="tgl_mulai" value="<?php //echo $kegiatan['tgl_mulai']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label> <input class="form-control" type="date"
                                id="tgl_selesai" name="tgl_selesai" value="<?php //echo $kegiatan['tgl_selesai']; ?>">
                        </div> -->
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
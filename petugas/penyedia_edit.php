<?php

include ('../koneksi.php');

if (isset($_POST['submit'])) {
    $id_penyedia = $_POST['id_penyedia'];
    $kode_penyedia = $_POST['kode_penyedia'];
    $nama_penyedia = $_POST['nama_penyedia'];
    $nama_direktur = $_POST['nama_direktur'];
    $alamat_penyedia = $_POST['alamat_penyedia'];
    $npwp = $_POST['npwp'];
    $nama_bank = $_POST['nama_bank'];
    $no_rek_bank = $_POST['no_rek_bank'];

    // Buat query update data ke database
    $sql = "UPDATE Penyedia SET
        kode_penyedia = ?,
        nama_penyedia = ?,
        nama_direktur = ?,
        alamat_penyedia = ?,
        npwp = ?,
        nama_bank = ?,
        no_rek_bank = ?
        WHERE id_penyedia = ?";

    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param(
        "sssssssi",
        $kode_penyedia,
        $nama_penyedia,
        $nama_direktur,
        $alamat_penyedia,
        $npwp,
        $nama_bank,
        $no_rek_bank,
        $id_penyedia
    );

    // Jalankan query update
    if ($stmt->execute()) {
        echo "<script>alert('Data penyedia dengan Nama: $nama_penyedia berhasil diperbarui!'); window.location.href = 'penyedia.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'penyedia.php';</script>";
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
                                <h4 style="margin-bottom: 0px">Edit Penyedia</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Penyedia</span></li>
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
                    <h3 class="panel-title">Edit Penyedia</h3>
                </div>
                <div class="panel-body">

                    <div class="pull-right">
                        <a href="penyedia.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <br>
                    <br>
                    <form action="penyedia_edit.php" method="post">
                        <?php

                        include ('../koneksi.php');
                        $id_penyedia = $_GET['id'];

                        // Query untuk mendapatkan data penyedia berdasarkan ID
                        $sql = "SELECT * FROM Penyedia WHERE id_penyedia = ?";
                        $stmt = $koneksi->prepare($sql);
                        $stmt->bind_param("i", $id_penyedia);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Cek apakah data ditemukan
                        if ($result->num_rows > 0) {
                            $penyedia = $result->fetch_assoc();
                        } else {
                            echo "<script>alert('Data penyedia tidak ditemukan.');window.location.href = 'penyedia.php';</script>";
                        }

                        ?>
                        <input type="hidden" name="id_penyedia" value="<?php echo $penyedia['id_penyedia']; ?>">
                        <div class="form-group">
                            <label for="kode_penyedia">Kode Penyedia *</label>
                            <input readonly class="form-control" type="text" id="kode_penyedia" name="kode_penyedia"
                                value="<?php echo $penyedia['kode_penyedia']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_penyedia">Nama Penyedia *</label>
                            <input class="form-control" type="text" id="nama_penyedia" name="nama_penyedia"
                                value="<?php echo $penyedia['nama_penyedia']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_direktur">Nama Direktur *</label>
                            <input class="form-control" type="text" id="nama_direktur" name="nama_direktur"
                                value="<?php echo $penyedia['nama_direktur']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_penyedia">Alamat Penyedia</label>
                            <textarea class="form-control" id="alamat_penyedia"
                                name="alamat_penyedia"><?php echo $penyedia['alamat_penyedia']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="npwp">NPWP *</label>
                            <input class="form-control" type="text" id="npwp" name="npwp"
                                value="<?php echo $penyedia['npwp']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_bank">Nama Bank *</label>
                            <input class="form-control" type="text" id="nama_bank" name="nama_bank"
                                value="<?php echo $penyedia['nama_bank']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="no_rek_bank">No. Rekening Bank *</label>
                            <input class="form-control" type="text" id="no_rek_bank" name="no_rek_bank"
                                value="<?php echo $penyedia['no_rek_bank']; ?>" required>
                        </div>
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
<?php

include ('../koneksi.php');

if (isset($_POST['submit'])) {
    $id_arsip_kegiatan = $_POST['id_arsip_kegiatan'];
    $id_kegiatan = $_POST['id_kegiatan'];
    $no_box = $_POST['no_box'];
    $nama_sub_kegiatan = $_POST['nama_sub_kegiatan'];
    $nama_pekerjaan = $_POST['nama_pekerjaan'];
    $alamat_pekerjaan = $_POST['alamat_pekerjaan'];
    $cara_pembayaran = $_POST['cara_pembayaran'];
    $no_kontrak = $_POST['no_kontrak'];
    $tgl_kontrak = $_POST['tgl_kontrak'];
    $no_basthp = $_POST['no_basthp'];
    $nilai_kontrak = $_POST['nilai_kontrak'];
    $lama_pekerjaan = $_POST['lama_pekerjaan'];
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $id_penyedia = $_POST['id_penyedia'];
    $no_reg = $_POST['no_reg'];
    $nilai_realisasi = $_POST['nilai_realisasi'];
    $ppn = $_POST['ppn'];
    $pph_21 = $_POST['pph_21'];
    $pph_22 = $_POST['pph_22'];
    $pph_23 = $_POST['pph_23'];
    $pph_4_2 = $_POST['pph_4_2'];
    $denda_keterlambatan = $_POST['denda_keterlambatan'];
    $no_spp = $_POST['no_spp'];
    $tgl_spp = $_POST['tgl_spp'];
    $no_spm = $_POST['no_spm'];
    $tgl_spm = $_POST['tgl_spm'];
    $keterangan = $_POST['keterangan'];

    // Buat query update data ke database
    $sql = "UPDATE arsip_kegiatan SET
                id_kegiatan = ?,
                no_box = ?,
                nama_sub_kegiatan = ?,
                nama_pekerjaan = ?,
                alamat_pekerjaan = ?,
                cara_pembayaran = ?,
                no_kontrak = ?,
                tgl_kontrak = ?,
                no_basthp = ?,
                nilai_kontrak = ?,
                lama_pekerjaan = ?,
                tgl_mulai = ?,
                tgl_selesai = ?,
                id_penyedia = ?,
                no_reg = ?,
                nilai_realisasi = ?,
                ppn = ?,
                pph_21 = ?,
                pph_22 = ?,
                pph_23 = ?,
                pph_4_2 = ?,
                denda_keterlambatan = ?,
                no_spp = ?,
                tgl_spp = ?,
                no_spm = ?,
                tgl_spm = ?,
                keterangan = ?
            WHERE id_arsip_kegiatan = ?";

    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param(
        "iisssssssssssssssssssssssssi",
        $id_kegiatan,
        $no_box,
        $nama_sub_kegiatan,
        $nama_pekerjaan,
        $alamat_pekerjaan,
        $cara_pembayaran,
        $no_kontrak,
        $tgl_kontrak,
        $no_basthp,
        $nilai_kontrak,
        $lama_pekerjaan,
        $tgl_mulai,
        $tgl_selesai,
        $id_penyedia,
        $no_reg,
        $nilai_realisasi,
        $ppn,
        $pph_21,
        $pph_22,
        $pph_23,
        $pph_4_2,
        $denda_keterlambatan,
        $no_spp,
        $tgl_spp,
        $no_spm,
        $tgl_spm,
        $keterangan,
        $id_arsip_kegiatan
    );

    // Jalankan query update
    if ($stmt->execute()) {
        echo "<script>alert('Data arsip kegiatan dengan ID $id_arsip_kegiatan berhasil diperbarui!'); window.location.href = 'arsip_kegiatan.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'arsip_kegiatan.php';</script>";
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
                                <h4 style="margin-bottom: 0px">Edit Arsip Kegiatan</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Arsip Kegiatan</span></li>
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
                    <h3 class="panel-title">Edit Arsip Kegiatan Sub Bagian Keuangan</h3>
                </div>
                <div class="panel-body">

                    <div class="pull-right">
                        <a href="arsip_kegiatan.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <br>
                    <br>
                    <!-- Styles -->
                    <!-- <link rel="stylesheet"
                        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> -->
                    <link rel="stylesheet"
                        href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
                    <link rel="stylesheet"
                        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
                    <!-- Or for RTL support -->
                    <link rel="stylesheet"
                        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

                    <form action="arsip_kegiatan_edit.php" method="post">
                        <?php
                        include ('../koneksi.php');

                        // Ambil ID arsip kegiatan dari parameter URL
                        $id_arsip_kegiatan = $_GET['id'];

                        // Buat query untuk mendapatkan data arsip kegiatan berdasarkan ID
                        $sql = "SELECT * FROM arsip_kegiatan WHERE id_arsip_kegiatan = ?";
                        $stmt = $koneksi->prepare($sql);
                        $stmt->bind_param("i", $id_arsip_kegiatan);
                        $stmt->execute();
                        $result = $stmt->get_result();


                        // Ambil data arsip kegiatan dari hasil query
                        $row = $result->fetch_assoc();
                        ?>
                        <div class="form-group">
                            <label for="no_reg">No. Registrasi *</label>
                            <input class="form-control" type="text" id="no_reg" name="no_reg" required
                                value="<?php echo $row['no_reg']; ?>" readonly>
                        </div>
                        <input type="hidden" name="id_arsip_kegiatan" value="<?php echo $id_arsip_kegiatan; ?>">
                        <div class="form-group">
                            <label for="id_kegiatan">Kegiatan *</label>
                            <select class="form-select" id="single-select-field" name="id_kegiatan"
                                data-placeholder="Cari Kegiatan" required>
                                <option value="">Pilih Kegiatan</option>
                                <?php
                                $sql_kegiatan = "SELECT id_kegiatan, kode_kegiatan, nama_kegiatan FROM Kegiatan";
                                $result_kegiatan = mysqli_query($koneksi, $sql_kegiatan);

                                if (mysqli_num_rows($result_kegiatan) > 0) {
                                    while ($row_kegiatan = mysqli_fetch_assoc($result_kegiatan)) {
                                        $selected = ($row['id_kegiatan'] == $row_kegiatan['id_kegiatan']) ? 'selected' : '';
                                        echo "<option value='" . $row_kegiatan['id_kegiatan'] . "' $selected>" . $row_kegiatan['kode_kegiatan'] . " - " . $row_kegiatan['nama_kegiatan'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Tidak ada data kegiatan</option>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_box">No. Box</label>
                            <input class="form-control" type="text" id="no_box" name="no_box"
                                value="<?php echo $row['no_box']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_sub_kegiatan">Nama Sub Kegiatan</label>
                            <input class="form-control" type="text" id="nama_sub_kegiatan" name="nama_sub_kegiatan"
                                value="<?php echo $row['nama_sub_kegiatan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_pekerjaan">Nama Pekerjaan *</label>
                            <input class="form-control" type="text" id="nama_pekerjaan" name="nama_pekerjaan"
                                value="<?php echo $row['nama_pekerjaan']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_pekerjaan">Alamat Pekerjaan *</label>
                            <input class="form-control" type="text" id="alamat_pekerjaan" name="alamat_pekerjaan"
                                value="<?php echo $row['alamat_pekerjaan']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="cara_pembayaran">Cara Pembayaran *</label>
                            <input class="form-control" type="text" id="cara_pembayaran" name="cara_pembayaran"
                                value="<?php echo $row['cara_pembayaran']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="no_kontrak">No. Kontrak</label>
                            <input class="form-control" type="text" id="no_kontrak" name="no_kontrak"
                                value="<?php echo $row['no_kontrak']; ?>">

                        </div>
                        <div class="form-group">
                            <label for="tgl_kontrak">Tanggal Kontrak</label>
                            <input class="form-control" type="date" id="tgl_kontrak" name="tgl_kontrak"
                                value="<?php echo $row['tgl_kontrak']; ?>">

                        </div>
                        <div class="form-group">
                            <label for="no_basthp">No. BASTHP</label>
                            <input class="form-control" type="text" id="no_basthp" name="no_basthp"
                                value="<?php echo $row['no_basthp']; ?>">

                        </div>
                        <div class="form-group">
                            <label for="nilai_kontrak">Nilai Kontrak</label>
                            <input class="form-control" type="number" id="nilai_kontrak" name="nilai_kontrak"
                                value="<?php echo $row['nilai_kontrak']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="lama_pekerjaan">Lama Pekerjaan</label>
                            <input class="form-control" type="text" id="lama_pekerjaan" name="lama_pekerjaan"
                                value="<?php echo $row['lama_pekerjaan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai</label>
                            <input class="form-control" type="date" id="tgl_mulai" name="tgl_mulai"
                                value="<?php echo $row['tgl_mulai']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input class="form-control" type="date" id="tgl_selesai" name="tgl_selesai"
                                value="<?php echo $row['tgl_selesai']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="id_penyedia">Penyedia *</label>
                            <select class="form-select" id="single-select-field2" name="id_penyedia"
                                data-placeholder="Cari Penyedia" required>
                                <?php
                                include ('../koneksi.php');

                                // Buat query untuk mendapatkan data penyedia
                                $sql_penyedia = "SELECT id_penyedia, kode_penyedia, nama_penyedia FROM Penyedia";
                                $result_penyedia = mysqli_query($koneksi, $sql_penyedia);

                                if (mysqli_num_rows($result_penyedia) > 0) {
                                    while ($row_penyedia = mysqli_fetch_assoc($result_penyedia)) {
                                        $selected = ($row['id_penyedia'] == $row_penyedia['id_penyedia']) ? 'selected' : '';
                                        echo "<option value='" . $row_penyedia['id_penyedia'] . "' $selected>" . $row_penyedia['kode_penyedia'] . " | " . $row_penyedia['nama_penyedia'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Tidak ada data penyedia</option>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nilai_realisasi">Nilai Realisasi *</label>
                            <input class="form-control" type="number" id="nilai_realisasi" name="nilai_realisasi"
                                required value="<?php echo $row['nilai_realisasi']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="ppn">PPN</label>
                            <input class="form-control" type="number" id="ppn" name="ppn"
                                value="<?php echo $row['ppn']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pph_21">PPh 21</label>
                            <input class="form-control" type="number" id="pph_21" name="pph_21"
                                value="<?php echo $row['pph_21']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pph_22">PPh 22</label>
                            <input class="form-control" type="number" id="pph_22" name="pph_22"
                                value="<?php echo $row['pph_22']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pph_23">PPh 23</label>
                            <input class="form-control" type="number" id="pph_23" name="pph_23"
                                value="<?php echo $row['pph_23']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pph_42">PPh 4(2)</label>
                            <input class="form-control" type="number" id="pph_4_2" name="pph_4_2"
                                value="<?php echo $row['pph_4_2']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="denda_keterlambatan">Denda Keterlambatan</label>
                            <input class="form-control" type="number" id="denda_keterlambatan"
                                name="denda_keterlambatan" value="<?php echo $row['denda_keterlambatan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="no_spp">No. SPP</label>
                            <input class="form-control" type="text" id="no_spp" name="no_spp"
                                value="<?php echo $row['no_spp']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl_spp">Tgl. SPP</label>
                            <input class="form-control" type="date" id="tgl_spp" name="tgl_spp"
                                value="<?php echo $row['tgl_spp']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="no_spm">No. SPM</label>
                            <input class="form-control" type="text" id="no_spm" name="no_spm"
                                value="<?php echo $row['no_spm']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl_spm">Tgl. SPM</label>
                            <input class="form-control" type="date" id="tgl_spm" name="tgl_spm"
                                value="<?php echo $row['tgl_spm']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan"><?php echo $row['keterangan']; ?></textarea>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="../js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="../js/datatables-simple-demo.js"></script>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>
    $('#single-select-field').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });

    $('#single-select-field2').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
</script>
<?php include 'footer.php'; ?>
<?php

include ('../koneksi.php');
function generateNoReg($koneksi)
{
    $prefix = "NOREG"; // Prefix untuk kode penyedia
    $tahun = date("y"); // Dua digit terakhir dari tahun saat ini
    $sql = "SELECT MAX(no_reg) AS max_no_reg FROM arsip_kegiatan WHERE no_reg LIKE '$prefix$tahun%'";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    $max_kode = $row['max_no_reg'];

    $no_urut = 1;
    if ($max_kode) {
        $no_urut = (int) substr($max_kode, -4) + 1;
    }

    $no_reg = $prefix . $tahun . sprintf("%04d", $no_urut);
    return $no_reg;
}

// Ambil data dari form
if (isset($_POST['submit'])) {
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
    $no_reg = generateNoReg($koneksi);
    $nilai_realisasi = $_POST['nilai_realisasi'];
    $ppn = (isset($_POST['ppn'])) ? $_POST['ppn'] : null;
    $pph_21 = (isset($_POST['pph_21'])) ? $_POST['pph_21'] : null;
    $pph_22 = (isset($_POST['pph_22'])) ? $_POST['pph_22'] : null;
    $pph_23 = (isset($_POST['pph_23'])) ? $_POST['pph_23'] : null;
    $pph_42 = (isset($_POST['pph_42'])) ? $_POST['pph_42'] : null;
    $denda_keterlambatan = (isset($_POST['denda_keterlambatan'])) ? $_POST['denda_keterlambatan'] : null;  // Check if Denda Keterlambatan is empty
    $no_spp = $_POST['no_spp'];
    $tgl_spp = $_POST['tgl_spp'];
    $no_spm = $_POST['no_spm'];
    $tgl_spm = $_POST['tgl_spm'];
    $keterangan = $_POST['keterangan'];

    // Insert data ke database
    $sql = "INSERT INTO arsip_kegiatan (
    id_kegiatan,
    no_box,
    nama_sub_kegiatan,
    nama_pekerjaan,
    alamat_pekerjaan,
    cara_pembayaran,
    no_kontrak,
    tgl_kontrak,
    no_basthp,
    nilai_kontrak,
    lama_pekerjaan,
    tgl_mulai,
    tgl_selesai,
    id_penyedia,
    no_reg,
    nilai_realisasi,
    ppn,
    pph_21,
    pph_22,
    pph_23,
    pph_4_2,
    denda_keterlambatan,
    no_spp,
    tgl_spp,
    no_spm,
    tgl_spm,
    keterangan
    )
VALUES (
  '$id_kegiatan',
  '$no_box',
  '$nama_sub_kegiatan',
  '$nama_pekerjaan',
  '$alamat_pekerjaan',
  '$cara_pembayaran',
  '$no_kontrak',
  '$tgl_kontrak',
  '$no_basthp',
  '$nilai_kontrak',
  '$lama_pekerjaan',
  '$tgl_mulai',
  '$tgl_selesai',
  '$id_penyedia',
  '$no_reg',
  '$nilai_realisasi',
  '$ppn',
  '$pph_21',
  '$pph_22',
  '$pph_23',
  '$pph_42',
  '$denda_keterlambatan',
  '$no_spp',
  '$tgl_spp',
  '$no_spm',
  '$tgl_spm',
  '$keterangan'
)";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href = 'arsip_kegiatan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href = 'arsip_kegiatan.php';</script>";
    }

    mysqli_close($koneksi);
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
                                <h4 style="margin-bottom: 0px">Tambah Arsip Kegiatan Sub Bagian Keuangan DINAS PRKP</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Arsip Kegiatan Sub Bagian Keuangan DINAS PRKP</span></li>
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
                    <h3 class="panel-title">Tambah Arsip Kegiatan Sub Bagian Keuangan DINAS PRKP</h3>
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

                    <form action="arsip_kegiatan_tambah.php" method="post">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="no_reg">No. Registrasi Dokumen*</label>
                                <input class="form-control" type="text" id="no_reg" name="no_reg"
                                    value="<?php echo generateNoReg($koneksi); ?>" readonly>
                            </div>
                            <label for="id_kegiatan">Kegiatan *</label>
                            <select class="form-select" id="single-select-field" name="id_kegiatan"
                                data-placeholder="Cari Kegiatan" required>
                                <option value="">Pilih Kegiatan</option>
                                <?php
                                include ('../koneksi.php');
                                // Ambil data kegiatan
                                $sql = "SELECT id_kegiatan, kode_kegiatan, nama_kegiatan FROM Kegiatan";
                                $result = mysqli_query($koneksi, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id_kegiatan'] . "'>" . $row['kode_kegiatan'] . " - " . $row['nama_kegiatan'] . "</option>";
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
                            <input class="form-control" type="text" id="no_box" name="no_box">
                        </div>
                        <div class="form-group">
                            <label for="nama_sub_kegiatan">Nama Sub Kegiatan</label>
                            <input class="form-control" type="text" id="nama_sub_kegiatan" name="nama_sub_kegiatan">
                        </div>
                        <div class="form-group">
                            <label for="nama_pekerjaan">Nama Pekerjaan *</label>
                            <input class="form-control" type="text" id="nama_pekerjaan" name="nama_pekerjaan" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_pekerjaan">Alamat Pekerjaan *</label>
                            <input class="form-control" type="text" id="alamat_pekerjaan" name="alamat_pekerjaan"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="cara_pembayaran">Cara Pembayaran *</label>
                            <input class="form-control" type="text" id="cara_pembayaran" name="cara_pembayaran"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="no_kontrak">No. Kontrak</label>
                            <input class="form-control" type="text" id="no_kontrak" name="no_kontrak">
                        </div>
                        <div class="form-group">
                            <label for="tgl_kontrak">Tanggal Kontrak</label>
                            <input class="form-control" type="date" id="tgl_kontrak" name="tgl_kontrak">
                        </div>
                        <div class="form-group">
                            <label for="no_basthp">No. BASTHP</label>
                            <input class="form-control" type="text" id="no_basthp" name="no_basthp">
                        </div>
                        <div class="form-group">
                            <label for="nilai_kontrak">Nilai Kontrak</label>
                            <input class="form-control" type="number" id="nilai_kontrak" name="nilai_kontrak">
                        </div>
                        <div class="form-group">
                            <label for="lama_pekerjaan">Lama Pekerjaan</label>
                            <input class="form-control" type="text" id="lama_pekerjaan" name="lama_pekerjaan">
                        </div>
                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai</label>
                            <input class="form-control" type="date" id="tgl_mulai" name="tgl_mulai">
                        </div>
                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input class="form-control" type="date" id="tgl_selesai" name="tgl_selesai">
                        </div>

                        <div class="form-group">
                            <label for="id_penyedia">Penyedia *</label>
                            <select class="form-select" id="single-select-field2" name="id_penyedia"
                                data-placeholder="Cari Penyedia" required>
                                <option value="">Pilih Penyedia</option>
                                <?php
                                include ('../koneksi.php');
                                // Ambil data penyedia
                                $sql = "SELECT id_penyedia, kode_penyedia, nama_penyedia FROM Penyedia";
                                $result = mysqli_query($koneksi, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id_penyedia'] . "'>" . $row['kode_penyedia'] . " | " . $row['nama_penyedia'] . "</option>";
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
                                required>
                        </div>
                        <div class="form-group">
                            <label for="ppn">PPN</label>
                            <input class="form-control" type="number" id="ppn" name="ppn">
                        </div>
                        <div class="form-group">
                            <label for="pph_21">PPh 21</label>
                            <input class="form-control" type="number" id="pph_21" name="pph_21">
                        </div>
                        <div class="form-group">
                            <label for="pph_22">PPh 22</label>
                            <input class="form-control" type="number" id="pph_22" name="pph_22">
                        </div>
                        <div class="form-group">
                            <label for="pph_23">PPh 23</label>
                            <input class="form-control" type="number" id="pph_23" name="pph_23">
                        </div>
                        <div class="form-group">
                            <label for="pph_42">PPh 4(2)</label>
                            <input class="form-control" type="number" id="pph_42" name="pph_42">
                        </div>
                        <div class="form-group">
                            <label for="denda_keterlambatan">Denda Keterlambatan</label>
                            <input class="form-control" type="number" id="denda_keterlambatan"
                                name="denda_keterlambatan">
                        </div>
                        <div class="form-group">
                            <label for="no_spp">No. SPP</label>
                            <input class="form-control" type="text" id="no_spp" name="no_spp">
                        </div>
                        <div class="form-group">
                            <label for="tgl_spp">Tgl. SPP</label>
                            <input class="form-control" type="date" id="tgl_spp" name="tgl_spp">
                        </div>
                        <div class="form-group">
                            <label for="no_spm">No. SPM</label>
                            <input class="form-control" type="text" id="no_spm" name="no_spm">
                        </div>
                        <div class="form-group">
                            <label for="tgl_spm">Tgl. SPM</label>
                            <input class="form-control" type="DATE" id="tgl_spm" name="tgl_spm">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan"></textarea>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                        </div>
                    </form>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
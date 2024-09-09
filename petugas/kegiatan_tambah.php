<?php

// Koneksi database
include ('../koneksi.php');

// Fungsi untuk menghasilkan kode kegiatan otomatis
function generateKodeKegiatan($koneksi)
{
    $prefix = "KG"; // Prefix untuk kode kegiatan
    $tahun = date("y"); // Tahun saat ini
    $sql = "SELECT MAX(kode_kegiatan) AS max_kode FROM kegiatan WHERE kode_kegiatan LIKE '$prefix$tahun%'";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    $max_kode = $row['max_kode'];

    $no_urut = 1;
    if ($max_kode) {
        $no_urut = (int) substr($max_kode, -4) + 1;
    }

    $kode_kegiatan = $prefix . $tahun . sprintf("%04d", $no_urut);
    return $kode_kegiatan;
}

// Ambil data dari form
if (isset($_POST['submit'])) {
    $kode_kegiatan = generateKodeKegiatan($koneksi);
    $nama_kegiatan = $_POST['nama_kegiatan'];
    // Insert data ke database
    $sql = "INSERT INTO kegiatan (
        kode_kegiatan,
        nama_kegiatan
    ) VALUES (
        '$kode_kegiatan',
        '$nama_kegiatan'
    )";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href = 'kegiatan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href = 'kegiatan.php';</script>";
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
                                <h4 style="margin-bottom: 0px">Tambah Kegiatan</h4>
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
                    <h3 class="panel-title">Tambah Kegiatan</h3>
                </div>
                <div class="panel-body">
                    <div class="pull-right">
                        <a href="kegiatan.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <br><br>
                    <form action="kegiatan_tambah.php" method="post">

                        <div class="form-group">
                            <label for="kode_kegiatan">Kode Kegiatan *</label>
                            <input class="form-control" type="text" id="kode_kegiatan" name="kode_kegiatan"
                                value="<?php echo generateKodeKegiatan($koneksi); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan *</label>
                            <input class="form-control" type="text" id="nama_kegiatan" name="nama_kegiatan" required>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                        </div>
                        <!-- <div class="form-group">
                            <label for="no_box">No. Box</label>
                            <input class="form-control" type="text" id="no_box" name="no_box">
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="nama_sub_kegiatan">Nama Sub Kegiatan</label>
                            <input class="form-control" type="text" id="nama_sub_kegiatan" name="nama_sub_kegiatan">
                        </div>
                        <div class="form-group">
                            <label for="nama_pekerjaan">Nama Pekerjaan *</label>
                            <input class="form-control" type="text" id="nama_pekerjaan" name="nama_pekerjaan" required>
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
                        -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
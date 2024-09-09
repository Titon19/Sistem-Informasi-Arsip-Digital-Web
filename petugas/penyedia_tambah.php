<?php
// Koneksi database
include ('../koneksi.php');

// Fungsi untuk menghasilkan kode penyedia otomatis
function generateKodePenyedia($koneksi)
{
    $prefix = "PY"; // Prefix untuk kode penyedia
    $tahun = date("y"); // Dua digit terakhir dari tahun saat ini
    $sql = "SELECT MAX(kode_penyedia) AS max_kode FROM penyedia WHERE kode_penyedia LIKE '$prefix$tahun%'";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    $max_kode = $row['max_kode'];

    $no_urut = 1;
    if ($max_kode) {
        $no_urut = (int) substr($max_kode, -4) + 1;
    }

    $kode_penyedia = $prefix . $tahun . sprintf("%04d", $no_urut);
    return $kode_penyedia;
}

// Ambil data dari form
if (isset($_POST['submit'])) {
    $kode_penyedia = generateKodePenyedia($koneksi); // Generate kode penyedia
    $nama_penyedia = $_POST['nama_penyedia'];
    $nama_direktur = $_POST['nama_direktur'];
    $alamat_penyedia = $_POST['alamat_penyedia'];
    $npwp = $_POST['npwp'];
    $nama_bank = $_POST['nama_bank'];
    $no_rek_bank = $_POST['no_rek_bank'];

    // Insert data ke database
    $sql = "INSERT INTO penyedia (
  kode_penyedia,
  nama_penyedia,
  nama_direktur,
  alamat_penyedia,
  npwp,
  nama_bank,
  no_rek_bank
)
VALUES (
  '$kode_penyedia',
  '$nama_penyedia',
  '$nama_direktur',
  '$alamat_penyedia',
  '$npwp',
  '$nama_bank',
  '$no_rek_bank'
)";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href = 'penyedia.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href = 'penyedia.php';</script>";
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
                                <h4 style="margin-bottom: 0px">Tambah Penyedia</h4>
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
                    <h3 class="panel-title">Tambah Penyedia</h3>
                </div>
                <div class="panel-body">

                    <div class="pull-right">
                        <a href="penyedia.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <br>
                    <br>
                    <form action="penyedia_tambah.php" method="post">
                        <div class="form-group">
                            <label for="kode_penyedia">Kode Penyedia *</label>
                            <input class="form-control" type="text" id="kode_penyedia" name="kode_penyedia"
                                value="<?php echo generateKodePenyedia($koneksi); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_penyedia">Nama Penyedia *</label>
                            <input class="form-control" type="text" id="nama_penyedia" name="nama_penyedia" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_direktur">Nama Direktur *</label>
                            <input class="form-control" type="text" id="nama_direktur" name="nama_direktur" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_penyedia">Alamat Penyedia</label>
                            <textarea id="alamat_penyedia" name="alamat_penyedia"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="npwp">NPWP *</label>
                            <input class="form-control" type="text" id="npwp" name="npwp" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_bank">Nama Bank *</label>
                            <input class="form-control" type="text" id="nama_bank" name="nama_bank" required>
                        </div>
                        <div class="form-group">
                            <label for="no_rek_bank">No. Rekening Bank *</label>
                            <input class="form-control" type="text" id="no_rek_bank" name="no_rek_bank" required>
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
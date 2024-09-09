<?php
include ('../koneksi.php');

if (isset($_GET['id'])) {
    $id_kegiatan = $_GET['id'];

    $sql = "SELECT * FROM kegiatan WHERE id_kegiatan = ?";

    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id_kegiatan);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $d = mysqli_fetch_assoc($result);
    } else {
        echo "Terjadi kesalahan pada persiapan statement.";
        exit;
    }

} else {
    echo "ID kegiatan tidak ditemukan.";
    exit;
}

mysqli_close($koneksi);
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
                                <h4 style="margin-bottom: 0px">Detail Kegiatan</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Detail Kegiatan</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="panel panel">
        <div class="panel-heading">
            <h3 class="panel-title">Detail Kegiatan</h3>
            <div class="pull-right">
                <a href="kegiatan.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <table class="table">
                <tr>
                    <th>Kode Kegiatan</th>
                    <td><?php echo $d['kode_kegiatan']; ?></td>
                </tr>
                <!-- <tr>
                    <th>No. Box</th>
                    <td><?php //echo $d['no_box']; ?></td>
                </tr> -->
                <tr>
                    <th>Nama Kegiatan</th>
                    <td><?php echo $d['nama_kegiatan']; ?></td>
                </tr>
                <!-- <tr>
                    <th>Nama Sub Kegiatan</th>
                    <td><?php //echo $d['nama_sub_kegiatan']; ?></td>
                </tr>
                <tr>
                    <th>Nama Pekerjaan</th>
                    <td><?php //echo $d['nama_pekerjaan']; ?></td>
                </tr>
                <tr>
                    <th>Alamat Pekerjaan</th>
                    <td><?php //echo $d['alamat_pekerjaan']; ?></td>
                </tr>
                <tr>
                    <th>Cara Pembayaran</th>
                    <td><?php //echo $d['cara_pembayaran']; ?></td>
                </tr>
                <tr>
                    <th>No. Kontrak</th>
                    <td><?php //echo $d['no_kontrak']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Kontrak</th>
                    <td><?php //echo $d['tgl_kontrak']; ?></td>
                </tr>
                <tr>
                    <th>No. BASthP</th>
                    <td><?php //echo $d['no_basthp']; ?></td>
                </tr>
                <tr>
                    <th>Nilai Kontrak</th>
                    <td><?php //echo $d['nilai_kontrak']; ?></td>
                </tr>
                <tr>
                    <th>Lama Pekerjaan</th>
                    <td><?php //echo $d['lama_pekerjaan']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Mulai</th>
                    <td><?php //echo $d['tgl_mulai']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Selesai</th>
                    <td><?php //echo $d['tgl_selesai']; ?></td>
                </tr> -->
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<?php
include ('../koneksi.php');

if (isset($_GET['id'])) {
    $id_penyedia = $_GET['id'];

    $sql = "SELECT * FROM penyedia WHERE id_penyedia = ?";

    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id_penyedia);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $d = mysqli_fetch_assoc($result);
    } else {
        echo "Terjadi kesalahan pada persiapan statement.";
        exit;
    }

} else {
    echo "ID penyedia tidak ditemukan.";
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
                                <h4 style="margin-bottom: 0px">Detail Penyedia</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Detail Penyedia</span></li>
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
            <h3 class="panel-title">Detail Penyedia</h3>
            <div class="pull-right">
                <a href="penyedia.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <table class="table">
                <tr>
                    <th>Kode Penyedia</th>
                    <td><?php echo $d['kode_penyedia']; ?></td>
                </tr>
                <tr>
                    <th>Nama Penyedia</th>
                    <td><?php echo $d['nama_penyedia']; ?></td>
                </tr>
                <tr>
                    <th>Nama Direktur</th>
                    <td><?php echo $d['nama_direktur']; ?></td>
                </tr>
                <tr>
                    <th>Alamat Penyedia</th>
                    <td><?php echo $d['alamat_penyedia']; ?></td>
                </tr>
                <tr>
                    <th>NPWP</th>
                    <td><?php echo $d['npwp']; ?></td>
                </tr>
                <tr>
                    <th>Nama Bank</th>
                    <td><?php echo $d['nama_bank']; ?></td>
                </tr>
                <tr>
                    <th>No. Rekening Bank</th>
                    <td><?php echo $d['no_rek_bank']; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
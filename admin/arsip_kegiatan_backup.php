<?php
// Mengambil koneksi database
include ('../koneksi.php');

$filter_tanggal_awal = isset($_GET['filter_tanggal_awal']) ? $_GET['filter_tanggal_awal'] : '';
$filter_tanggal_akhir = isset($_GET['filter_tanggal_akhir']) ? $_GET['filter_tanggal_akhir'] : '';

// Query untuk mengambil data dari arsip_kegiatan
$sql = "SELECT arsip_kegiatan.*, Kegiatan.nama_kegiatan, Penyedia.nama_penyedia
        FROM arsip_kegiatan
        INNER JOIN Kegiatan ON arsip_kegiatan.id_kegiatan = Kegiatan.id_kegiatan
        INNER JOIN Penyedia ON arsip_kegiatan.id_penyedia = Penyedia.id_penyedia";

if (!empty($filter_tanggal_awal) && !empty($filter_tanggal_akhir)) {
    // Format tanggal awal dan akhir ke format yang sesuai untuk kueri SQL
    $filter_tanggal_awal = date('Y-m-d', strtotime($filter_tanggal_awal));
    $filter_tanggal_akhir = date('Y-m-d', strtotime($filter_tanggal_akhir));

    $sql .= " WHERE DATE(arsip_kegiatan.tgl_input) BETWEEN '$filter_tanggal_awal' AND '$filter_tanggal_akhir'";
}
$result = mysqli_query($koneksi, $sql);

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
                                <h4 style="margin-bottom: 0px">Arsip Kegiatan Sub Bagian Keuangan DINAS PRKP</h4>
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
    <div class="panel panel">
        <div class="panel-heading">
            <h3 class="panel-title">Arsip Kegiatan Sub Bagian Keuangan DINAS PRKP</h3>
            <div class="col">
                <form method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="filter_tanggal_awal">Periode Tanggal dari:</label>
                        <input class="form-control" type="date" id="filter_tanggal_awal" name="filter_tanggal_awal">
                    </div>
                    <div class="form-group">
                        <label for="filter_tanggal_akhir">Periode Tanggal hingga:</label>
                        <input class="form-control" type="date" id="filter_tanggal_akhir" name="filter_tanggal_akhir">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
            <div class="pull-right">
                <a href="../cetak_arsip_kegiatan.php<?php if (isset($_GET['filter_tanggal_awal'])) {
                    echo "?filter_tanggal_awal=" . $_GET['filter_tanggal_awal'];
                } ?><?php if (isset($_GET['filter_tanggal_akhir'])) {
                     echo "&filter_tanggal_akhir=" . $_GET['filter_tanggal_akhir'];
                 } ?>" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Cetak Arsip Sub Kegiatan</a>
            </div>
        </div>
        <div class="panel-body">
            <!-- <div class="pull-right">
                <a href="arsip_kegiatan_tambah.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
                    Arsip Kegiatan</a>
            </div> -->
            <br>
            <br>
            <br>
            <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>No. Reg</th>
                        <th>No. Box</th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Penyedia</th>
                        <th>Nilai Realisasi</th>
                        <th>Denda Keterlambatan</th>
                        <th>Tgl Input</th>
                        <th>Keterangan</th>
                        <th class="text-center" width="10%">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['no_reg']; ?></td>
                            <td><?php echo $row['no_box']; ?></td>
                            <td><?php echo $row['nama_kegiatan']; ?></td>
                            <td><?php echo $row['nama_penyedia']; ?></td>
                            <td><?php echo $row['nilai_realisasi']; ?></td>
                            <td><?php echo $row['denda_keterlambatan']; ?></td>
                            <td><?php echo $row['tgl_input']; ?></td>
                            <td><?php echo $row['keterangan']; ?></td>
                            <td>
                                <div class="btn-group" style="display:flex; justify-content:center;">
                                    <!-- <a href="arsip_kegiatan_edit.php?id=<?php //echo $row['id_arsip_kegiatan']; ?>"
                                        class="btn btn-default"><i class="fa fa-wrench"></i></a>
                                    <a href="arsip_kegiatan_hapus.php?id=<?php //echo $row['id_arsip_kegiatan']; ?>"
                                        class="btn btn-default"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fa fa-trash"></i>
                                    </a> -->
                                    <a href="arsip_kegiatan_detail.php?id=<?php echo $row['id_arsip_kegiatan']; ?>"
                                        class="btn btn-default"><i class="fa fa-search"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>


<?php include 'footer.php'; ?>
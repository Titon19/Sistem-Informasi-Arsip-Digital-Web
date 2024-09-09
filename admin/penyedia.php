<?php
// Mengambil koneksi database
include ('../koneksi.php');

// Query untuk mengambil data dari tabel Penyedia
$sql = "SELECT * FROM Penyedia";
$result = mysqli_query($koneksi, $sql);

// Inisialisasi variabel untuk menyimpan data
$penyedia_data = array();

// Memeriksa apakah query berhasil dijalankan
if (mysqli_num_rows($result) > 0) {
    // Mendapatkan data dan menyimpannya dalam array
    while ($row = mysqli_fetch_assoc($result)) {
        $penyedia_data[] = $row;
    }
} else {
    echo "Tidak ada data";
}

// Menutup koneksi database
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
                                <h4 style="margin-bottom: 0px">Data Penyedia</h4>
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
    <div class="panel panel">

        <div class="panel-heading">
            <h3 class="panel-title">Data Penyedia</h3>
        </div>
        <div class="panel-body">

            <!-- <div class="pull-right">
                <a href="penyedia_tambah.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Penyedia</a>
            </div> -->
            <br>
            <br>
            <br>
            <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Kode Penyedia</th>
                        <th>Nama Penyedia</th>
                        <th>Nama Direktur</th>
                        <th>Alamat Penyedia</th>
                        <th>NPWP</th>
                        <!-- <th>Nama Bank</th>
                        <th>No. Rekening Bank</th> -->
                        <th class="text-center" width="10%">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($penyedia_data as $row) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['kode_penyedia']; ?></td>
                            <td><?php echo $row['nama_penyedia']; ?></td>
                            <td><?php echo $row['nama_direktur']; ?></td>
                            <td><?php echo $row['alamat_penyedia']; ?></td>
                            <td><?php echo $row['npwp']; ?></td>
                            <!-- <td><?php //echo $penyedia['nama_bank']; ?></td>
                            <td><?php //echo $penyedia['no_rek_bank']; ?></td> -->
                            <td>
                                <div class="btn-group" style="display:flex; justify-content:center;">
                                    <!-- <a href="penyedia_edit.php?id=<?php //echo $row['id_penyedia']; ?>"
                                        class="btn btn-default"><i class="fa fa-wrench"></i></a>
                                    <a href="penyedia_hapus.php?id=<?php //echo $row['id_penyedia']; ?>"
                                        class="btn btn-default"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fa fa-trash"></i>
                                    </a> -->
                                    <a href="penyedia_detail.php?id=<?php echo $row['id_penyedia']; ?>"
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
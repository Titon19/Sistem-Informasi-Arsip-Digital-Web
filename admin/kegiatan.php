<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Data Kegiatan</h4>
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
    <div class="panel panel">

        <div class="panel-heading">
            <h3 class="panel-title">Data Kegiatan</h3>
        </div>
        <div class="panel-body">

            <!-- <div class="pull-right">
                <a href="kegiatan_tambah.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kegiatan</a>
            </div> -->
            <br>
            <br>
            <br>
            <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Kode Kegiatan</th>
                        <th>Nama Kegiatan</th>
                        <th class="text-center" width="10%">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $no = 1;
                    $result = mysqli_query($koneksi, "SELECT * FROM kegiatan ORDER BY id_kegiatan DESC");
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['kode_kegiatan']; ?></td>
                            <td><?php echo $row['nama_kegiatan']; ?></td>
                            <td class="text-center">

                                <div class="btn-group" style="display:flex; justify-content:center;">
                                    <!-- <a href="kegiatan_edit.php?id=<?php echo $row['id_kegiatan']; ?>"
                                        class="btn btn-default"><i class="fa fa-wrench"></i></a>
                                    <a href="kegiatan_hapus.php?id=<?php echo $row['id_kegiatan']; ?>"
                                        class="btn btn-default"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fa fa-trash"></i>
                                    </a> -->
                                    <a href="kegiatan_detail.php?id=<?php echo $row['id_kegiatan']; ?>"
                                        class="btn btn-default"><i class="fa fa-search"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>


        </div>

    </div>
</div>


<?php include 'footer.php'; ?>
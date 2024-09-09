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
                        <input class="form-control" type="date" id="filter_tanggal_awal" name="filter_tanggal_awal"
                            value="<?php echo htmlspecialchars($filter_tanggal_awal); ?>">
                    </div>
                    <div class="form-group">
                        <label for="filter_tanggal_akhir">Periode Tanggal hingga:</label>
                        <input class="form-control" type="date" id="filter_tanggal_akhir" name="filter_tanggal_akhir"
                            value="<?php echo htmlspecialchars($filter_tanggal_akhir); ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>

            </div>
            <!-- <div class="pull-right">
                <form id="printForm" method="POST" action="../cetak_arsip_kegiatan.php" target="_blank">
                    <input type="hidden" name="selected_ids" id="selected_ids">

                    <a href="#" class="btn btn-primary" target="_blank" onclick="submitPrintForm()"><i
                            class="fa fa-print"></i> Cetak Arsip Sub Kegiatan</a>
                </form>
            </div> -->

            <div class="pull-right">
                <form id="printForm" method="POST" action="../cetak_arsip_kegiatan.php" target="_blank">
                    <input type="hidden" name="selected_ids" id="selected_ids">
                    <a href="../cetak_arsip_kegiatan.php<?php if (isset($_GET['filter_tanggal_awal'])) {
                        echo "?filter_tanggal_awal=" . $_GET['filter_tanggal_awal'];
                    } ?><?php if (isset($_GET['filter_tanggal_akhir'])) {
                         echo "&filter_tanggal_akhir=" . $_GET['filter_tanggal_akhir'];
                     } ?>" class="btn btn-primary" target="_blank" id="filter"><i class="fa fa-print"></i> Cetak
                        Arsip Sub
                        Kegiatan</a>
                </form>
            </div>

        </div>
        <div class="panel-body" style="overflow-x: scroll;width: 99%;">
            <div class="pull-right">
                <a href="arsip_kegiatan_tambah.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Arsip
                    Kegiatan</a>
            </div>
            <br>
            <br>
            <br>
            <form id="deleteForm" method="POST" action="deleteOption.php">
                <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                    <thead>
                        <tr>
                            <th>Pilih</th>
                            <th width="1%">No</th>
                            <th>No. Reg</th>
                            <th>No. Box</th>
                            <th>Nama Kegiatan</th>
                            <th>Nama Sub Kegiatan</th>
                            <th>Nama Penyedia</th>
                            <th>Nilai Realisasi</th>
                            <th>No. Kontrak</th>
                            <th>No. BASTHP</th>
                            <th>Tgl Input</th>
                            <th>Tgl Mulai</th>
                            <th>Keterangan</th>
                            <th class="text-center" width="10%">OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><input type="checkbox" name="id[]"
                                        value="<?php echo htmlspecialchars($row['id_arsip_kegiatan']); ?>">
                                </td>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['no_reg']); ?></td>
                                <td><?php echo htmlspecialchars($row['no_box']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_kegiatan']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_sub_kegiatan']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_penyedia']); ?></td>
                                <td><?php echo htmlspecialchars($row['nilai_realisasi']); ?></td>
                                <td><?php echo htmlspecialchars($row['no_kontrak']); ?></td>
                                <td><?php echo htmlspecialchars($row['no_basthp']); ?></td>
                                <td><?php echo htmlspecialchars($row['tgl_input']); ?></td>
                                <td><?php echo htmlspecialchars($row['tgl_mulai']); ?></td>
                                <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="arsip_kegiatan_edit.php?id=<?php echo htmlspecialchars($row['id_arsip_kegiatan']); ?>"
                                            class="btn btn-default"><i class="fa fa-wrench"></i></a>
                                        <a href="arsip_kegiatan_hapus.php?id=<?php echo htmlspecialchars($row['id_arsip_kegiatan']); ?>"
                                            class="btn btn-default"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                class="fa fa-trash"></i></a>
                                        <a href="arsip_kegiatan_detail.php?id=<?php echo htmlspecialchars($row['id_arsip_kegiatan']); ?>"
                                            class="btn btn-default"><i class="fa fa-search"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-primary" type="button" id="selectAllButton">Select ALL</button>
                <div>
                    <button class="btn btn-danger" type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')">Delete</button>
                </div>
            </form>
            <br>
        </div>
    </div>
</div>
<script>
    // Flag to track if all checkboxes are checked
    var allChecked = false;

    // Toggle checkbox state when "selectAllButton" is clicked
    document.getElementById('selectAllButton').addEventListener('click', function () {
        var checkboxes = document.querySelectorAll('input[name="id[]"]');
        allChecked = !allChecked;
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = allChecked;
        });
        updatePrintButton();
    });

    // Update the print button based on the checkbox state
    function updatePrintButton() {
        const filter = document.querySelector('#filter');
        const checkboxes = document.querySelectorAll('input[name="id[]"]');
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (anyChecked) {
            filter.setAttribute('onclick', 'submitPrintForm(); return false;');
        } else {
            filter.removeAttribute('onclick');
        }
    }

    // Function to handle form submission
    function submitPrintForm() {
        var selectedIds = [];
        var checkboxes = document.querySelectorAll('input[name="id[]"]:checked');
        checkboxes.forEach(function (checkbox) {
            selectedIds.push(checkbox.value);
        });
        document.getElementById('selected_ids').value = selectedIds.join(',');
        document.getElementById('printForm').submit();
    }

    // cek and update tombol cetak saat load
    document.addEventListener('DOMContentLoaded', function () {
        updatePrintButton();
    });

    // Update tombol cetak ketika checkbox is terubah
    document.addEventListener('change', function (event) {
        if (event.target.matches('input[name="id[]"]')) {
            updatePrintButton();
        }
    });
</script>
<?php include 'footer.php'; ?>
<?php
include 'header.php';
include '../koneksi.php';

$filter_tanggal_awal = isset($_GET['filter_tanggal_awal']) ? $_GET['filter_tanggal_awal'] : '';
$filter_tanggal_akhir = isset($_GET['filter_tanggal_akhir']) ? $_GET['filter_tanggal_akhir'] : '';

// Format tanggal awal dan akhir ke format yang sesuai untuk kueri SQL
$filter_tanggal_awal = !empty($filter_tanggal_awal) ? date('Y-m-d', strtotime($filter_tanggal_awal)) : '';
$filter_tanggal_akhir = !empty($filter_tanggal_akhir) ? date('Y-m-d', strtotime($filter_tanggal_akhir)) : '';

// Query untuk admin
$sql_admin = "SELECT 
                 riwayat_preview.*, 
                 arsip.arsip_id, 
                 arsip.arsip_nama, 
                 `admin`.admin_nama AS nama_user 
             FROM 
                 riwayat_preview 
                 INNER JOIN arsip ON riwayat_preview.riwayat_arsip = arsip.arsip_id 
                 INNER JOIN `admin` ON riwayat_preview.riwayat_user = `admin`.admin_id";

// Query untuk user
$sql_user = "SELECT 
                 riwayat_preview.*, 
                 arsip.arsip_id, 
                 arsip.arsip_nama, 
                 `user`.user_nama AS nama_user 
             FROM 
                 riwayat_preview 
                 INNER JOIN arsip ON riwayat_preview.riwayat_arsip = arsip.arsip_id 
                 INNER JOIN `user` ON riwayat_preview.riwayat_user = `user`.user_id";

// Query untuk petugas
$sql_petugas = "SELECT 
                 riwayat_preview.*, 
                 arsip.arsip_id, 
                 arsip.arsip_nama, 
                 petugas.petugas_nama AS nama_user 
             FROM 
                 riwayat_preview 
                 INNER JOIN arsip ON riwayat_preview.riwayat_arsip = arsip.arsip_id 
                 INNER JOIN petugas ON riwayat_preview.riwayat_user = petugas.petugas_id";

// Gabungkan query menggunakan UNION dan tambahkan filter
$sql = "$sql_admin UNION $sql_user UNION $sql_petugas";

// Menambahkan filter tanggal jika tersedia
if (!empty($filter_tanggal_awal) && !empty($filter_tanggal_akhir)) {
    $sql = "($sql_admin WHERE DATE(riwayat_preview_waktu) BETWEEN '$filter_tanggal_awal' AND '$filter_tanggal_akhir') 
            UNION 
            ($sql_user WHERE DATE(riwayat_preview_waktu) BETWEEN '$filter_tanggal_awal' AND '$filter_tanggal_akhir') 
            UNION 
            ($sql_petugas WHERE DATE(riwayat_preview_waktu) BETWEEN '$filter_tanggal_awal' AND '$filter_tanggal_akhir')";
} else {
    $sql .= " ORDER BY riwayat_preview_id DESC";
}

// Debug: Tampilkan query SQL
// echo "<pre>$sql</pre>";

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}
?>


<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Data Riwayat Preview</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Riwayat</span></li>
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
            <div class="pull-right">
                <form id="printForm" method="POST" action="cetak_riwayat_preview.php" target="_blank">
                    <input type="hidden" name="filter_tanggal_awal"
                        value="<?php echo htmlspecialchars($filter_tanggal_awal); ?>">
                    <input type="hidden" name="filter_tanggal_akhir"
                        value="<?php echo htmlspecialchars($filter_tanggal_akhir); ?>">
                    <input type="hidden" name="selected_ids" id="selected_ids">


                    <a href="cetak_riwayat_preview.php<?php if (isset($_GET['filter_tanggal_awal'])) {
                        echo "?filter_tanggal_awal=" . $_GET['filter_tanggal_awal'];
                    } ?><?php if (isset($_GET['filter_tanggal_akhir'])) {
                         echo "&filter_tanggal_akhir=" . $_GET['filter_tanggal_akhir'];
                     } ?>" class="btn btn-primary" target="_blank" id="filter"><i class="fa fa-print"></i> Cetak
                        Riwayat Preview</a>
                </form>
            </div>
            <h3 class="panel-title">Data Riwayat Preview Arsip</h3>
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
        </div>
        <div class="panel-body">
            <form id="deleteForm" method="POST" action="deleteOptionRiwayatPreview.php">
                <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                    <thead>
                        <tr>
                            <th>Pilih</th>
                            <th width="1%">No</th>
                            <th width="18%">Waktu Preview</th>
                            <th width="30%">Role</th>
                            <th width="30%">Arsip yang dipreview</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($result) {
                            while ($p = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="id[]"
                                            value="<?php echo htmlspecialchars($p['riwayat_preview_id']); ?>">
                                    </td>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo date('H:i:s  d-m-Y', strtotime($p['riwayat_preview_waktu'])) ?></td>
                                    <td><?php echo htmlspecialchars($p['nama_user']) ?></td>
                                    <td><?php echo htmlspecialchars($p['arsip_nama']) ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="riwayat_preview_hapus.php?id=<?php echo $p['riwayat_preview_id']; ?>"
                                                class="btn btn-default"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button class="btn btn-primary" type="button" id="selectAllButton">Select ALL</button>
                <div>
                    <button class="btn btn-danger" type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>
<script>
    // Flag to track if all checkboxes are checked
    var allChecked = false;

    document.getElementById('selectAllButton').addEventListener('click', function () {
        var checkboxes = document.querySelectorAll('input[name="id[]"]');
        allChecked = !allChecked;
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = allChecked;
        });
        updatePrintButton();
    });

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

    function submitPrintForm() {
        var selectedIds = [];
        var checkboxes = document.querySelectorAll('input[name="id[]"]:checked');
        checkboxes.forEach(function (checkbox) {
            selectedIds.push(checkbox.value);
        });
        document.getElementById('selected_ids').value = selectedIds.join(',');
        document.getElementById('printForm').submit();
    }

    document.addEventListener('DOMContentLoaded', function () {
        updatePrintButton();
    });

    document.addEventListener('change', function (event) {
        if (event.target.matches('input[name="id[]"]')) {
            updatePrintButton();
        }
    });

</script>
<?php include 'footer.php'; ?>
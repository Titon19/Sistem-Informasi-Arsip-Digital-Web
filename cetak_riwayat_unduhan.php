<?php
include 'koneksi.php';

// Mengambil data filter dari GET atau POST
$filter_tanggal_awal = isset($_GET['filter_tanggal_awal']) ? $_GET['filter_tanggal_awal'] : '';
$filter_tanggal_akhir = isset($_GET['filter_tanggal_akhir']) ? $_GET['filter_tanggal_akhir'] : '';
$filter_ids = isset($_POST['selected_ids']) ? $_POST['selected_ids'] : ''; // Mengambil array filter_ids

// Format tanggal awal dan akhir ke format yang sesuai untuk kueri SQL
$filter_tanggal_awal = !empty($filter_tanggal_awal) ? date('Y-m-d', strtotime($filter_tanggal_awal)) : '';
$filter_tanggal_akhir = !empty($filter_tanggal_akhir) ? date('Y-m-d', strtotime($filter_tanggal_akhir)) : '';

// Mengubah string filter_ids menjadi array ID yang dipisahkan koma
$filter_ids = !empty($filter_ids) ? implode(',', array_map('intval', explode(',', $filter_ids))) : '';

// Query dasar untuk admin, user, dan petugas
$sql_admin = "SELECT 
                 riwayat.*, 
                 arsip.arsip_id, 
                 arsip.arsip_nama, 
                 `admin`.admin_nama AS nama_user 
             FROM 
                 riwayat 
                 INNER JOIN arsip ON riwayat.riwayat_arsip = arsip.arsip_id 
                 INNER JOIN `admin` ON riwayat.riwayat_user = `admin`.admin_id";

// Query dasar untuk user
$sql_user = "SELECT 
                 riwayat.*, 
                 arsip.arsip_id, 
                 arsip.arsip_nama, 
                 `user`.user_nama AS nama_user 
             FROM 
                 riwayat 
                 INNER JOIN arsip ON riwayat.riwayat_arsip = arsip.arsip_id 
                 INNER JOIN `user` ON riwayat.riwayat_user = `user`.user_id";

// Query dasar untuk petugas
$sql_petugas = "SELECT 
                 riwayat.*, 
                 arsip.arsip_id, 
                 arsip.arsip_nama, 
                 petugas.petugas_nama AS nama_user 
             FROM 
                 riwayat 
                 INNER JOIN arsip ON riwayat.riwayat_arsip = arsip.arsip_id 
                 INNER JOIN petugas ON riwayat.riwayat_user = petugas.petugas_id";

// Menentukan filter berdasarkan apakah ID dipilih atau tanggal
if (!empty($filter_ids)) {
    // Filter berdasarkan ID
    $sql = "$sql_admin WHERE riwayat_id IN ($filter_ids)
            UNION
            $sql_user WHERE riwayat_id IN ($filter_ids)
            UNION
            $sql_petugas WHERE riwayat_id IN ($filter_ids)
            ORDER BY riwayat_id DESC";
} elseif (!empty($filter_tanggal_awal) && !empty($filter_tanggal_akhir)) {
    // Filter berdasarkan tanggal
    $sql = "$sql_admin WHERE DATE(riwayat_waktu) BETWEEN '$filter_tanggal_awal' AND '$filter_tanggal_akhir'
            UNION
            $sql_user WHERE DATE(riwayat_waktu) BETWEEN '$filter_tanggal_awal' AND '$filter_tanggal_akhir'
            UNION
            $sql_petugas WHERE DATE(riwayat_waktu) BETWEEN '$filter_tanggal_awal' AND '$filter_tanggal_akhir'
            ORDER BY riwayat_id DESC";
} else {
    // Jika tidak ada filter yang diterapkan
    $sql = "$sql_admin
            UNION
            $sql_user
            UNION
            $sql_petugas
            ORDER BY riwayat_id DESC";
}

// Debug: Tampilkan query SQL
// echo "<pre>$sql</pre>";

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}

// Mengambil tahun dari riwayat_preview_waktu
$row = mysqli_fetch_assoc($result);
$tahun = $row ? date('Y', strtotime($row['riwayat_waktu'])) : date('Y');

require_once __DIR__ . '/vendor/autoload.php';

$html = '
<div style="text-align:center">
    <h1>RIWAYAT ARSIP DOWNLOAD</h1><br>
    <h1>Tahun ' . $tahun . '</h1>
</div>
<table border="1" cellspacing="0" cellpadding="5" style="margin: 0 auto;">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th>Waktu Upload</th>
            <th>Nama Anggota</th>
            <th>Arsip yang dipreview</th>
        </tr>
    </thead>
    <tbody>';

$no = 1;
do {
    $html .= '
    <tr>
        <td>' . $no++ . '</td>
        <td>' . date('H:i:s  d-m-Y', strtotime($row['riwayat_waktu'])) . '</td>
        <td>' . $row['nama_user'] . '</td>
        <td>' . $row['arsip_nama'] . '</td>
    </tr>';
} while ($row = mysqli_fetch_assoc($result));

$html .= '
    </tbody>
</table>';

$mpdf = new \Mpdf\Mpdf([
    'format' => [1189, 841], // A4 landscape
    'orientation' => 'L'
]);
$mpdf->WriteHTML($html);
$mpdf->Output('riwayat_preview.pdf', \Mpdf\Output\Destination::INLINE);
?>
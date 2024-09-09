<?php
// Mengambil koneksi database
include ('koneksi.php');

$filter_tanggal_awal = isset($_GET['filter_tanggal_awal']) ? $_GET['filter_tanggal_awal'] : '';
$filter_tanggal_akhir = isset($_GET['filter_tanggal_akhir']) ? $_GET['filter_tanggal_akhir'] : '';
$selected_ids = isset($_POST['selected_ids']) ? $_POST['selected_ids'] : '';

// Debug: Tampilkan data filter
// echo 'Tanggal Awal: ' . htmlspecialchars($filter_tanggal_awal) . '<br>';
// echo 'Tanggal Akhir: ' . htmlspecialchars($filter_tanggal_akhir) . '<br>';
// echo 'Selected IDs: ' . htmlspecialchars($selected_ids) . '<br>';

// Mulai membangun SQL query
$sql = "SELECT
            arsip_kegiatan.no_reg, 
            arsip_kegiatan.no_box, 
            kegiatan.nama_kegiatan, 
            arsip_kegiatan.nama_sub_kegiatan, 
            arsip_kegiatan.nama_pekerjaan, 
            arsip_kegiatan.alamat_pekerjaan, 
            arsip_kegiatan.cara_pembayaran, 
            arsip_kegiatan.no_kontrak, 
            arsip_kegiatan.tgl_kontrak, 
            arsip_kegiatan.no_basthp, 
            arsip_kegiatan.nilai_kontrak, 
            arsip_kegiatan.lama_pekerjaan, 
            arsip_kegiatan.tgl_mulai, 
            arsip_kegiatan.tgl_selesai, 
            penyedia.nama_penyedia, 
            penyedia.nama_direktur, 
            penyedia.alamat_penyedia, 
            penyedia.npwp, 
            penyedia.nama_bank, 
            penyedia.no_rek_bank, 
            arsip_kegiatan.nilai_realisasi, 
            arsip_kegiatan.denda_keterlambatan, 
            arsip_kegiatan.keterangan, 
            arsip_kegiatan.tgl_input
        FROM
            arsip_kegiatan
        INNER JOIN
            kegiatan
        ON 
            arsip_kegiatan.id_kegiatan = kegiatan.id_kegiatan
        INNER JOIN
            penyedia
        ON 
            arsip_kegiatan.id_penyedia = penyedia.id_penyedia";

// Tambahkan filter tanggal jika ada
if (!empty($filter_tanggal_awal) && !empty($filter_tanggal_akhir)) {
    $filter_tanggal_awal = date('Y-m-d', strtotime($filter_tanggal_awal));
    $filter_tanggal_akhir = date('Y-m-d', strtotime($filter_tanggal_akhir));
    $sql .= " WHERE DATE(arsip_kegiatan.tgl_input) BETWEEN '$filter_tanggal_awal' AND '$filter_tanggal_akhir'";
}

// Tambahkan filter ID jika ada
if (!empty($selected_ids)) {
    $ids_array = explode(',', $selected_ids);
    $ids = implode(',', array_map('intval', $ids_array)); // Sanitasi ID
    $sql .= (strpos($sql, 'WHERE') === false ? " WHERE" : " AND") . " arsip_kegiatan.id_arsip_kegiatan IN ($ids)";
}

// Debug: Tampilkan SQL query yang dihasilkan
// echo 'SQL Query: ' . htmlspecialchars($sql) . '<br>';

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die('Query Error: ' . mysqli_error($koneksi));
}

// Mengambil tahun dari tgl_input
$tahun_anggaran = '';
if ($row = mysqli_fetch_assoc($result)) {
    $tahun_anggaran = date('Y', strtotime($row['tgl_mulai']));
    mysqli_data_seek($result, 0); // Reset pointer hasil query
}

require_once __DIR__ . '/vendor/autoload.php';

$html = '
<div style="text-align:center">
    <h1>ARSIP KEGIATAN SUB BAGIAN KEUANGAN DINAS PRKP</h1><br>
    <h1>T.A ' . htmlspecialchars($tahun_anggaran) . '</h1>
</div>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th>No. Reg</th>
            <th>No. Box</th>
            <th>Nama Kegiatan</th>
            <th>Nama Sub Kegiatan</th>
            <th>Nama Pekerjaan</th>
            <th>Alamat Pekerjaan</th>
            <th>Cara Pembayaran</th>
            <th>No. Kontrak</th>
            <th>Tgl. Kontrak</th>
            <th>No. BASthP</th>
            <th>Nilai Kontrak</th>
            <th>Lama Pekerjaan</th>
            <th>Tgl. Mulai</th>
            <th>Tgl. Selesai</th>
            <th>Nama Penyedia</th>
            <th>Nama Direktur</th>
            <th>Alamat Penyedia</th>
            <th>NPWP</th>
            <th>Nama Bank</th>
            <th>No. Rek Bank</th>
            <th>Nilai Realisasi</th>
            <th>Denda Keterlambatan</th>
            <th>Keterangan</th>
            <th>Tgl Input</th>
        </tr>
    </thead>
    <tbody>';

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . htmlspecialchars($row['no_reg']) . '</td>
            <td>' . htmlspecialchars($row['no_box']) . '</td>
            <td>' . htmlspecialchars($row['nama_kegiatan']) . '</td>
            <td>' . htmlspecialchars($row['nama_sub_kegiatan']) . '</td>
            <td>' . htmlspecialchars($row['nama_pekerjaan']) . '</td>
            <td>' . htmlspecialchars($row['alamat_pekerjaan']) . '</td>
            <td>' . htmlspecialchars($row['cara_pembayaran']) . '</td>
            <td>' . htmlspecialchars($row['no_kontrak']) . '</td>
            <td>' . htmlspecialchars($row['tgl_kontrak']) . '</td>
            <td>' . htmlspecialchars($row['no_basthp']) . '</td>
            <td> Rp.' . number_format($row['nilai_kontrak'], 0, ',', '.') . '</td>
            <td>' . htmlspecialchars($row['lama_pekerjaan']) . '</td>
            <td>' . htmlspecialchars($row['tgl_mulai']) . '</td>
            <td>' . htmlspecialchars($row['tgl_selesai']) . '</td>
            <td>' . htmlspecialchars($row['nama_penyedia']) . '</td>
            <td>' . htmlspecialchars($row['nama_direktur']) . '</td>
            <td>' . htmlspecialchars($row['alamat_penyedia']) . '</td>
            <td>' . htmlspecialchars($row['npwp']) . '</td>
            <td>' . htmlspecialchars($row['nama_bank']) . '</td>
            <td>' . htmlspecialchars($row['no_rek_bank']) . '</td>
            <td> Rp.' . number_format($row['nilai_realisasi'], 0, ',', '.') . '</td>
            <td> Rp.' . number_format($row['denda_keterlambatan'], 0, ',', '.') . '</td>
            <td>' . htmlspecialchars($row['keterangan']) . '</td>
            <td>' . htmlspecialchars($row['tgl_input']) . '</td>
        </tr>';
}

$html .= '
    </tbody>
</table>';

$mpdf = new \Mpdf\Mpdf([
    'format' => [1189, 841], // A4 format
    'orientation' => 'L' // Landscape orientation
]);
$mpdf->WriteHTML($html);
$mpdf->Output('arsip_kegiatan.pdf', \Mpdf\Output\Destination::INLINE);
?>
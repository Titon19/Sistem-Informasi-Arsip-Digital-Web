<?php
// Mengambil koneksi database
include ('koneksi.php');

$filter_tanggal_awal = isset($_GET['filter_tanggal_awal']) ? $_GET['filter_tanggal_awal'] : '';
$filter_tanggal_akhir = isset($_GET['filter_tanggal_akhir']) ? $_GET['filter_tanggal_akhir'] : '';

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
            arsip_kegiatan.ppn, 
            arsip_kegiatan.pph_21, 
            arsip_kegiatan.pph_22, 
            arsip_kegiatan.pph_23, 
            arsip_kegiatan.pph_4_2, 
            arsip_kegiatan.denda_keterlambatan, 
            arsip_kegiatan.no_spp, 
            arsip_kegiatan.tgl_spp, 
            arsip_kegiatan.no_spm, 
            arsip_kegiatan.tgl_spm, 
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

if (!empty($filter_tanggal_awal) && !empty($filter_tanggal_akhir)) {
    // Format tanggal awal dan akhir ke format yang sesuai untuk kueri SQL
    $filter_tanggal_awal = date('Y-m-d', strtotime($filter_tanggal_awal));
    $filter_tanggal_akhir = date('Y-m-d', strtotime($filter_tanggal_akhir));

    $sql .= " WHERE DATE(arsip_kegiatan.tgl_input) BETWEEN '$filter_tanggal_awal' AND '$filter_tanggal_akhir'";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_ids = isset($_POST['selected_ids']) ? $_POST['selected_ids'] : '';
    if (!empty($selected_ids)) {
        $ids_array = explode(',', $selected_ids);
        $ids = implode(',', array_map('intval', $ids_array));
        $sql .= " AND arsip_kegiatan.id_arsip_kegiatan IN ($ids)";
    }
}

$result = mysqli_query($koneksi, $sql);

// Mengambil tahun dari tgl_input
$row = mysqli_fetch_assoc($result);
$tahun_anggaran = date('Y', strtotime($row['tgl_mulai']));

require_once __DIR__ . '/vendor/autoload.php';

$html = '
<div style="text-align:center">
    <h1>ARSIP KEGIATAN SUB BAGIAN KEUANGAN DINAS PRKP</h1><br>
    <h1>T.A ' . $tahun_anggaran . '</h1>
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
do {
    $html .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . $row['no_reg'] . '</td>
            <td>' . $row['no_box'] . '</td>
            <td>' . $row['nama_kegiatan'] . '</td>
            <td>' . $row['nama_sub_kegiatan'] . '</td>
            <td>' . $row['nama_pekerjaan'] . '</td>
            <td>' . $row['alamat_pekerjaan'] . '</td>
            <td>' . $row['cara_pembayaran'] . '</td>
            <td>' . $row['no_kontrak'] . '</td>
            <td>' . $row['tgl_kontrak'] . '</td>
            <td>' . $row['no_basthp'] . '</td>
            <td> Rp.' . $row['nilai_kontrak'] . '</td>
            <td>' . $row['lama_pekerjaan'] . '</td>
            <td>' . $row['tgl_mulai'] . '</td>
            <td>' . $row['tgl_selesai'] . '</td>
            <td>' . $row['nama_penyedia'] . '</td>
            <td>' . $row['nama_direktur'] . '</td>
            <td>' . $row['alamat_penyedia'] . '</td>
            <td>' . $row['npwp'] . '</td>
            <td>' . $row['nama_bank'] . '</td>
            <td>' . $row['no_rek_bank'] . '</td>
            <td>  Rp.' . $row['nilai_realisasi'] . '</td>
            <td> Rp.' . $row['denda_keterlambatan'] . '</td>
            <td>' . $row['keterangan'] . '</td>
            <td>' . $row['tgl_input'] . '</td>
        </tr>';
} while ($row = mysqli_fetch_assoc($result));

$html .= '
    </tbody>
</table>';

$mpdf = new \Mpdf\Mpdf([
    'format' => [1189, 841],
    'orientation' => 'L'
]);
$mpdf->WriteHTML($html);
$mpdf->Output('arsip_kegiatan.pdf', \Mpdf\Output\Destination::INLINE);
?>
<?php
include ('../koneksi.php');

if (isset($_GET['id'])) {
    $id_arsip_kegiatan = $_GET['id'];

    $sql = "SELECT
    arsip_kegiatan.*, 
    kegiatan.kode_kegiatan, 
    kegiatan.nama_kegiatan, 
    penyedia.kode_penyedia, 
    penyedia.nama_penyedia, 
    penyedia.nama_direktur, 
    penyedia.alamat_penyedia, 
    penyedia.npwp, 
    penyedia.nama_bank, 
    penyedia.no_rek_bank
    FROM
    arsip_kegiatan
    INNER JOIN
    kegiatan
    ON 
        arsip_kegiatan.id_kegiatan = kegiatan.id_kegiatan
    INNER JOIN
    penyedia
    ON 
        arsip_kegiatan.id_penyedia = penyedia.id_penyedia
    WHERE
    arsip_kegiatan.id_arsip_kegiatan = ?";

    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id_arsip_kegiatan);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $d = mysqli_fetch_assoc($result);
    } else {
        echo "Terjadi kesalahan pada persiapan statement.";
        exit;
    }

} else {
    echo "ID arsip kegiatan tidak ditemukan.";
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
                                <h4 style="margin-bottom: 0px">Detail Arsip Kegiatan Sub Bagian Keuangan DINAS PRKP</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Detail Arsip Kegiatan Sub Bagian Keuangan DINAS PRKP</span>
                                </li>
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
            <h3 class="panel-title">Detail Arsip Kegiatan Sub Bagian Keuangan DINAS PRKP</h3>
            <div class="pull-right">
                <a href="arsip_kegiatan.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <table class="table">
                <tr>
                    <th>No. Reg</th>
                    <td><?php echo $d['no_reg']; ?></td>
                </tr>
                <tr>
                    <th>No. Box</th>
                    <td><?php echo $d['no_box']; ?></td>
                </tr>
                <tr>
                    <th>Kode Kegiatan</th>
                    <td><?php echo $d['kode_kegiatan']; ?></td>
                </tr>
                <tr>
                    <th>Nama Kegiatan</th>
                    <td><?php echo $d['nama_kegiatan']; ?></td>
                </tr>
                <tr>
                    <th>Nama Sub Kegiatan</th>
                    <td><?php echo $d['nama_sub_kegiatan']; ?></td>
                </tr>
                <tr>
                    <th>Nama Pekerjaan</th>
                    <td><?php echo $d['nama_pekerjaan']; ?></td>
                </tr>
                <tr>
                    <th>Alamat Pekerjaan</th>
                    <td><?php echo $d['alamat_pekerjaan']; ?></td>
                </tr>
                <tr>
                    <th>Cara Pembayaran</th>
                    <td><?php echo $d['cara_pembayaran']; ?></td>
                </tr>
                <tr>
                    <th>No. Kontrak</th>
                    <td><?php echo $d['no_kontrak']; ?></td>
                </tr>
                <tr>
                    <th>Tgl. Kontrak</th>
                    <td><?php echo $d['tgl_kontrak']; ?></td>
                </tr>
                <tr>
                    <th>No. BASTHP</th>
                    <td><?php echo $d['no_basthp']; ?></td>
                </tr>
                <tr>
                    <th>Nilai Kontrak</th>
                    <td><?php echo $d['nilai_kontrak']; ?></td>
                </tr>
                <tr>
                    <th>Lama Pekerjaan</th>
                    <td><?php echo $d['lama_pekerjaan']; ?></td>
                </tr>
                <tr>
                    <th>Tgl. Mulai</th>
                    <td><?php echo $d['tgl_mulai']; ?></td>
                </tr>
                <tr>
                    <th>Tgl. Selex sai</th>
                    <td><?php echo $d['tgl_selesai']; ?></td>
                </tr>
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
                    <th>No. Rek Bank</th>
                    <td><?php echo $d['no_rek_bank']; ?></td>
                </tr>
                <tr>
                    <th>Nilai Realisasi</th>
                    <td><?php echo $d['nilai_realisasi']; ?></td>
                </tr>
                <tr>
                    <th>PPN</th>
                    <td><?php echo $d['ppn']; ?></td>
                </tr>
                <tr>
                    <th>PPH 21</th>
                    <td><?php echo $d['pph_21']; ?></td>
                </tr>
                <tr>
                    <th>PPH 22</th>
                    <td><?php echo $d['pph_22']; ?></td>
                </tr>
                <tr>
                    <th>PPH 23</th>
                    <td><?php echo $d['pph_23']; ?></td>
                </tr>
                <tr>
                    <th>PPH 4 Ayat 2</th>
                    <td><?php echo $d['pph_4_2']; ?></td>
                </tr>
                <tr>
                    <th>Denda Keterlambatan</th>
                    <td><?php echo $d['denda_keterlambatan']; ?></td>
                </tr>
                <tr>
                    <th>No. SPP</th>
                    <td><?php echo $d['no_spp']; ?></td>
                </tr>
                <tr>
                    <th>Tgl. SPP</th>
                    <td><?php echo $d['tgl_spp']; ?></td>
                </tr>
                <tr>
                    <th>No. SPM</th>
                    <td><?php echo $d['no_spm']; ?></td>
                </tr>
                <tr>
                    <th>Tgl. SPM</th>
                    <td><?php echo $d['tgl_spm']; ?></td>
                </tr>
                <tr>
                    <th>Tgl Input</th>
                    <td><?php echo $d['tgl_input']; ?></td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td><?php echo $d['keterangan']; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>